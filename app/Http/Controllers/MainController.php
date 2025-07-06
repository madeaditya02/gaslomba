<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Lomba;
use App\Models\Peserta;
use App\Models\Tingkatan;
use App\Models\CabangLomba;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Models\JenisPerlombaan;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\LombaResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\PendaftaranResource;

class MainController extends Controller
{
    public function index()
    {
        $data = Lomba::latest()->take(3)->get(['id_lomba', 'nama_perlombaan', 'pamflet_perlombaan']);
        return Inertia::render('Landing', ['data' => $data]);
    }
    public function explore(Request $request)
    {
        $filter = $request->only(['search', 'tingkatan', 'kategori']);
        $query = Lomba::latest();
        if (isset($filter['search'])) {
            $query = $query->where('nama_perlombaan', 'like', '%'. $filter['search'] .'%');
        } if (isset($filter['tingkatan'])) {
            $query = $query->with('cabang_lomba.tingkatan')->whereHas('cabang_lomba.tingkatan', function($q) use($filter) {
                $q->where('tingkatan.id_tingkatan', $filter['tingkatan']);
            });
        }
        if (isset($filter['jenis_perlombaan'])) {
            $query = $query->whereHas('jenis_perlombaan', function($q) use($filter) {
                $q->where('jenis_perlombaan.id_kategori', $filter['kategori']);
            });
        }
        $data = LombaResource::collection($query->whereDate('tanggal_mulai', '<=', today())->whereDate('tanggal_selesai', '>=', today())->paginate(10)->appends($filter));
        return Inertia::render('Explore', [
            'data' => $data,
            'tingkatan' => Tingkatan::get(['id_tingkatan', 'nama_tingkatan']),
            'kategori' => JenisPerlombaan::get(['id_kategori', 'nama_kategori']),
            'filter' => $filter
        ]);
    }
    public function details($id)
    {
        // dd(Lomba::with(['jenis_perlombaan', 'cabang_lomba.tingkatan', 'penyelenggara'])->findOrFail($id)->cabang_lomba->pluck('tingkatan')->flatten()->pluck('nama_tingkatan')->unique());
        $lomba = Lomba::with(['jenis_perlombaan', 'cabang_lomba.tingkatan', 'penyelenggara'])->findOrFail($id);
        // dd($lomba->tanggal_selesai >= today());
        if (!($lomba->tanggal_mulai <= today() && $lomba->tanggal_selesai >= today())) {
            return back();
        }
        $lomba = new LombaResource($lomba);
        return Inertia::render('DetailLomba', ['lomba' => $lomba]);
    }
    public function daftar($id)
    {
        if (!auth()->user()->peserta) {
            return abort('403');
        }
        $sudahDidaftar = CabangLomba::whereHas('pendaftaran', function ($query) {
            $query->whereHas('peserta', function ($q) {
                $q->where('peserta.id_peserta', auth()->user()->peserta->id_peserta);
            });
        })->where('id_lomba', $id)->select(['id_cablom'])->get()->pluck('id_cablom');
        $lomba = Lomba::with(['jenis_perlombaan', 'cabang_lomba.tingkatan', 'penyelenggara'])->findOrFail($id);
        if (!($lomba->tanggal_mulai <= today() && $lomba->tanggal_selesai >= today())) {
            return back();
        }
        if ($sudahDidaftar->count() == $lomba->cabang_lomba->count()) {
            return back();
        }
        $lomba->cabang_lomba = $lomba->cabang_lomba->filter(function ($cablom) use ($sudahDidaftar) {
            return !$sudahDidaftar->contains($cablom->id_cablom);
        });

        $lomba = new LombaResource($lomba);
        return Inertia::render('DaftarLomba', [
            'lomba' => $lomba
        ]);
    }
    public function submitDaftar($id, Request $request)
    {
        $data = $request->validate([
            'cabang_lomba' => 'required',
            'berkas' => 'required',
            'bukti_pembayaran' => 'required',
            'kode_anggota' => 'required',
            'berkas_anggota' => 'required',
        ]);
        $data_anggota = $request->only(['kode_anggota', 'berkas_anggota']);
        if (count($data_anggota['kode_anggota']) < count($data_anggota['berkas_anggota'])) {
            return back()->withErrors(['kode_anggota' => 'Identitas anggota tidak lengkap']);
        } else if (count($data_anggota['kode_anggota']) > count($data_anggota['berkas_anggota'])) {
            return back()->withErrors(['berkas_anggota' => 'File berkas anggota tidak lengkap']);
        }
        
        $data_peserta = Peserta::whereIn('kode_identitas', $data['kode_anggota'])->get();
        if ($data_peserta->count() < count($data_anggota['kode_anggota'])) {
            return back()->withErrors(['kode_anggota' => 'Terdapat ID yang tidak ditemukan']);
        }
        
        $tingkatan = CabangLomba::with('tingkatan')->find($data['cabang_lomba'])->tingkatan->pluck('id_tingkatan');
        foreach ($data_peserta as $p) {
            if (!$tingkatan->contains($p->jenjang->id_tingkatan)) {
                return back()->withErrors(['kode_anggota' => 'Terdapat peserta yang tidak sesuai jenjangnya']);
            }
        }

        $extension = $request->file('bukti_pembayaran')->getClientOriginalExtension();
        $fileName = time().".$extension";
        $path = $request->file('bukti_pembayaran')->storeAs('bukti_pembayaran', $fileName, 'public');
        $bukti_pembayaran = asset('storage/bukti_pembayaran/'.$fileName);

        $pendaftaran = Pendaftaran::create([
            'bukti_pembayaran' => $bukti_pembayaran,
            'status' => 'Pending',
            'id_cablom' => $data['cabang_lomba'],
        ]);

        $extension = $request->file('berkas')->getClientOriginalExtension();
        $berkasKetuaName = $pendaftaran->id . "-" . auth()->user()->peserta->kode_identitas . ".$extension";
        $request->file('berkas')->storeAs('berkas_identitas', $berkasKetuaName, 'public');
        $peserta = [auth()->user()->peserta->id_peserta => ['role' => 'Ketua', 'berkas_identitas' => asset('storage/berkas_identitas/'.$berkasKetuaName)]];
        
        foreach ($data_anggota['kode_anggota'] as $i => $kode) {
            $extension = $data_anggota['berkas_anggota'][$i]->getClientOriginalExtension();
            $berkasAnggotaName = $pendaftaran->id . "-" . $kode . ".$extension";
            $data_anggota['berkas_anggota'][$i]->storeAs('berkas_identitas', $berkasAnggotaName, 'public');
            $id = $data_peserta->first(fn ($p) => $p->kode_identitas == $kode)->id_peserta;
            $peserta[$id] = ['role' => 'Anggota', 'berkas_identitas' => asset('storage/berkas_identitas/'.$berkasAnggotaName)];
        }
        $pendaftaran->peserta()->attach($peserta);

        return redirect('/dashboard/lomba')->with('alert', ['title' => 'Pendaftaran berhasil dilakukan.', 'text' => 'Silahkan tunggu hingga penyelenggara selesai memvalidasi pendaftaran.', 'type' => 'success']);
    }
    public function perbaikan($id)
    {
        $pendaftaran = new PendaftaranResource(Pendaftaran::with(['cabang_lomba.lomba', 'peserta'])->whereHas('peserta', function ($query) {
            $query->where('peserta.id_peserta', auth()->user()->peserta->id_peserta);
        })->where('id', $id)->first());
        // if (!($lomba->tanggal_mulai <= today() && $lomba->tanggal_selesai >= today())) {
        //     return back();
        // }
        return Inertia::render('PerbaikanDaftar', ['pendaftaran' => $pendaftaran, 'lomba' => new LombaResource($pendaftaran->cabang_lomba->lomba)]);
    }

    public function submitPerbaikan($id, Request $request)
    {
        $data_anggota = $request->only(['kode_anggota', 'berkas_anggota']);

        $pendaftaran = Pendaftaran::findOrFail($id);
        if ($request->file('bukti_pembayaran')) {
            $prevFile = str($pendaftaran->bukti_pembayaran)->explode('/')->last();
            Storage::delete('public/bukti_pembayaran/'.$prevFile);
            $extension = $request->file('bukti_pembayaran')->getClientOriginalExtension();
            $fileName = time().".$extension";
            $path = $request->file('bukti_pembayaran')->storeAs('bukti_pembayaran', $fileName, 'public');
            $bukti_pembayaran = asset('storage/bukti_pembayaran/'.$fileName);
            $pendaftaran->bukti_pembayaran = $bukti_pembayaran;
        }

        array_unshift($data_anggota['kode_anggota'], auth()->user()->peserta->kode_identitas);
        array_unshift($data_anggota['berkas_anggota'], $request->file('berkas'));

        $pendaftaran->status = 'Pending';
        $data_peserta = Peserta::whereIn('kode_identitas', $data_anggota['kode_anggota'])->get();
        foreach ($data_anggota['kode_anggota'] as $i => $kode) {
            if ($data_anggota['berkas_anggota'][$i] instanceof UploadedFile) {
                $extension = $data_anggota['berkas_anggota'][$i]->getClientOriginalExtension();
                $berkasAnggotaName = $pendaftaran->id . "-" . $kode . ".$extension";
                $data_anggota['berkas_anggota'][$i]->storeAs('berkas_identitas', $berkasAnggotaName, 'public');
                $id = $data_peserta->first(fn ($p) => $p->kode_identitas == $kode)->id_peserta;
                $pendaftaran->peserta()->updateExistingPivot($id, ['berkas_identitas' => asset('/storage/berkas_identitas/'.$berkasAnggotaName)]);
            }
        }
        $pendaftaran->save();
        return redirect('/dashboard/lomba')->with('alert', ['title' => 'Data pendaftaran berhasil diperbarui.', 'text' => 'Silahkan tunggu kembali hingga penyelenggara selesai memvalidasi pendaftaran.', 'type' => 'success']);
    }
}
