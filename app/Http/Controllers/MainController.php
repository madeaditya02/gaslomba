<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Lomba;
use App\Models\Peserta;
use App\Models\Tingkatan;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Models\JenisPerlombaan;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\LombaResource;
use Illuminate\Support\Facades\Storage;

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
        $lomba = Lomba::with(['jenis_perlombaan', 'cabang_lomba.tingkatan', 'penyelenggara'])->findOrFail($id);
        if (!($lomba->tanggal_mulai <= today() && $lomba->tanggal_selesai >= today())) {
            return back();
        }
        $lomba = new LombaResource($lomba);
        return Inertia::render('DaftarLomba', ['lomba' => $lomba]);
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

        $extension = $request->file('bukti_pembayaran')->getClientOriginalExtension();
        $fileName = time().".$extension";
        $path = $request->file('bukti_pembayaran')->storeAs('bukti_pembayaran', $fileName, 'public');
        $bukti_pembayaran = asset('storage/bukti_pembayaran/'.$fileName);
        // $lomba = Lomba::with(['jenis_perlombaan', 'cabang_lomba.tingkatan', 'penyelenggara'])->findOrFail($id);
        // if (!($lomba->tanggal_mulai <= today() && $lomba->tanggal_selesai >= today())) {
        //     return back();
        // }
        $pendaftaran = Pendaftaran::create([
            'bukti_pembayaran' => $bukti_pembayaran,
            'status' => 'Pending',
            'id_cablom' => $data['cabang_lomba'],
        ]);

        $extension = $request->file('berkas')->getClientOriginalExtension();
        $berkasKetuaName = $pendaftaran->id . "-" . auth()->user()->peserta->id_peserta . ".$extension";
        $request->file('berkas')->storeAs('berkas_identitas', $berkasKetuaName, 'public');
        $peserta = [auth()->user()->peserta->id_peserta => ['role' => 'Ketua', 'berkas_identitas' => asset('storage/berkas_identitas/'.$berkasKetuaName)]];
        
        foreach ($data_anggota['kode_anggota'] as $i => $kode) {
            $extension = $data_anggota['berkas_anggota'][$i]->getClientOriginalExtension();
            $berkasAnggotaName = $pendaftaran->id . "-" . $kode . ".$extension";
            $data_anggota['berkas_anggota'][$i]->storeAs('berkas_identitas', $berkasAnggotaName, 'public');
            $id = $data_peserta->first(fn ($p) => $p->kode_identitas == $kode)->id_peserta;
            $peserta[$id] = ['role' => 'Anggota', 'berkas_identitas' => asset('storage/berkas_identitas/'.$berkasAnggotaName)];
        }

        // $peserta = $peserta->mapWithKeys(function ($item) {
        //     return [$item->id_peserta => ['role' => 'Anggota']];
        // });
        // $peserta[auth()->user()->peserta->id_peserta] = ['role' => 'Ketua'];
        $pendaftaran->peserta()->attach($peserta);

        return redirect('/dashboard');
    }
}
