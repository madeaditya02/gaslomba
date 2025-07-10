<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Lomba;
use App\Models\Tingkatan;
use App\Models\CabangLomba;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Models\JenisPerlombaan;
use App\Http\Resources\LombaResource;
use App\Http\Resources\PendaftaranResource;

class LombaController extends Controller
{
    public function index()
    {
        if (auth()->user()->peserta) {
            $data = PendaftaranResource::collection(auth()->user()->peserta->pendaftaran()->with(['cabang_lomba', 'peserta'])->get());
            return Inertia::render('LombaPeserta', ['perlombaan' => $data]);
        } else {
            $data = LombaResource::collection(auth()->user()->penyelenggara->lomba);
            return Inertia::render('LombaPenyelenggara', ['perlombaan' => $data]);
        }
    }
    public function detail($id)
    {
        $lomba = Lomba::with(['cabang_lomba.pendaftaran.peserta', 'penyelenggara'])->findOrFail($id);
        if (!auth()->user()->penyelenggara) {
            return abort(403);
        }
        if ($lomba->penyelenggara->id_penyelenggara != auth()->user()->penyelenggara->id_penyelenggara) {
            return abort(403);
        }
        $data = PendaftaranResource::collection($lomba->cabang_lomba->pluck('pendaftaran')->flatten());
        return Inertia::render('DetailLombaPenyelenggara', [
            'lomba' => new LombaResource($lomba),
            'pendaftaran' => $data,
        ]);
    }
    public function updateStatus($id, $id_daftar, Request $request)
    {
        $lomba = Lomba::findOrFail($id);
        if (!auth()->user()->penyelenggara) {
            return abort(403);
        }
        if ($lomba->penyelenggara->id_penyelenggara != auth()->user()->penyelenggara->id_penyelenggara) {
            return abort(403);
        }
        $data = $request->validate(['status' => 'required']);
        if ($data['status'] == 'Rejected') {
            $data['catatan_panitia'] = $request->catatan_panitia;
        }
        Pendaftaran::findOrFail($id_daftar)->update($data);
    }
    public function tambah()
    {
        if (!auth()->user()->penyelenggara) {
            return abort(403);
        }
        $kategori = JenisPerlombaan::all();
        $tingkatan = Tingkatan::all();
        return Inertia::render('admin/TambahLomba', [
            'list_kategori' => $kategori,
            'list_tingkatan' => $tingkatan,
        ]);
    }
    public function simpan(Request $request)
    {
        if (!auth()->user()->penyelenggara) {
            return abort(403);
        }
        $data = $request->validate([
            'nama_perlombaan' => 'required',
            'kategori' => 'required',
            'pamflet_perlombaan' => 'required|image',
            'tempat_perlombaan' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'rekening' => 'required',
            'deskripsi' => 'required',
            'jumlah_cablom' => 'required',
            'nama_cablom' => 'required',
            'tingkatan' => 'required',
            'jumlah_anggota' => 'required',
            'biaya' => 'required',
        ]);
        $data_cablom = $request->only(['nama_cablom', 'tingkatan', 'jumlah_anggota', 'biaya']);
        if (collect($data_cablom['nama_cablom'])->filter()->count() < $data['jumlah_cablom']) {
            return back()->withErrors(['nama_cablom' => 'Nama cabang lomba tidak lengkap']);
        }
        if (collect($data_cablom['tingkatan'])->filter()->count() < $data['jumlah_cablom']) {
            return back()->withErrors(['tingkatan' => 'Nama cabang lomba tidak lengkap']);
        }
        if (collect($data_cablom['jumlah_anggota'])->filter()->count() < $data['jumlah_cablom']) {
            return back()->withErrors(['jumlah_anggota' => 'Nama cabang lomba tidak lengkap']);
        }
        if (collect($data_cablom['biaya'])->filter()->count() < $data['jumlah_cablom']) {
            return back()->withErrors(['biaya' => 'Nama cabang lomba tidak lengkap']);
        }

        $pamflet_perlombaan;
        if ($request->file('pamflet_perlombaan')) {
            $extension = $request->file('pamflet_perlombaan')->getClientOriginalExtension();
            $fileName = time().".$extension";
            $path = $request->file('pamflet_perlombaan')->storeAs('pamflet-lomba', $fileName, 'public');
            $pamflet_perlombaan = asset('storage/pamflet-lomba/'.$fileName);
        }
        $lomba = Lomba::create([
            'nama_perlombaan' => $data['nama_perlombaan'],
            'tempat_perlombaan' => $data['tempat_perlombaan'],
            'deskripsi' => $data['deskripsi'],
            'tanggal_mulai' => $data['tanggal_mulai'],
            'tanggal_selesai' => $data['tanggal_selesai'],
            'pamflet_perlombaan' => $pamflet_perlombaan,
            'rekening' => $data['rekening'],
            'id_penyelenggara' => auth()->user()->penyelenggara->id_penyelenggara
        ]);

        $kategoriYangAda = JenisPerlombaan::whereIn('id_kategori', $data['kategori'])->get();
        $kategoriBelumAda = collect($data['kategori'])->filter(function ($kategori) use ($kategoriYangAda) {
            return !$kategoriYangAda->contains('id_kategori', $kategori);
        })->map(function ($kategori) {
            return [
                'id_kategori' => $kategori,
                'nama_kategori' => ucfirst($kategori),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->all();
        JenisPerlombaan::insert($kategoriBelumAda);

        $lomba->jenis_perlombaan()->attach($data['kategori']);

        for ($i=0; $i < $data['jumlah_cablom']; $i++) { 
            $cablom = $lomba->cabang_lomba()->create([
                'nama_cablom' => $data['nama_cablom'][$i],
                'jumlah_anggota' => $data['jumlah_anggota'][$i],
                'biaya' => $data['biaya'][$i],
            ]);
            $cablom->tingkatan()->attach($data['tingkatan'][$i]);
        }
        return redirect('/dashboard/lomba')->with('alert', ['title' => 'Lomba berhasil ditambah.', 'type' => 'success']);
    }
    public function edit($id)
    {
        $lomba = new LombaResource(Lomba::with(['cabang_lomba.tingkatan', 'jenis_perlombaan'])->findOrFail($id));
        if (!auth()->user()->penyelenggara) {
            return abort(403);
        }
        if ($lomba->penyelenggara->id_penyelenggara != auth()->user()->penyelenggara->id_penyelenggara) {
            return abort(403);
        }
        $kategori = JenisPerlombaan::all();
        $tingkatan = Tingkatan::all();
        return Inertia::render('admin/EditLomba', [
            'list_kategori' => $kategori,
            'list_tingkatan' => $tingkatan,
            'lomba' => $lomba
        ]);
    }
    public function update($id, Request $request)
    {
        $lomba = Lomba::with('cabang_lomba')->findOrFail($id);
        if (!auth()->user()->penyelenggara) {
            return abort(403);
        }
        if ($lomba->penyelenggara->id_penyelenggara != auth()->user()->penyelenggara->id_penyelenggara) {
            return abort(403);
        }
        $data = $request->validate([
            'nama_perlombaan' => 'required',
            'kategori' => 'required',
            'tempat_perlombaan' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'rekening' => 'required',
            'deskripsi' => 'required',
            'jumlah_cablom' => 'required',
            'nama_cablom' => 'required',
            'tingkatan' => 'required',
            'jumlah_anggota' => 'required',
            'biaya' => 'required',
        ]);
        $data_cablom = $request->only(['nama_cablom', 'tingkatan', 'jumlah_anggota', 'biaya']);
        if (collect($data_cablom['nama_cablom'])->filter()->count() < $data['jumlah_cablom']) {
            return back()->withErrors(['nama_cablom' => 'Nama cabang lomba tidak lengkap']);
        }
        if (collect($data_cablom['tingkatan'])->filter()->count() < $data['jumlah_cablom']) {
            return back()->withErrors(['tingkatan' => 'Tingkatan tidak lengkap']);
        }
        if (collect($data_cablom['jumlah_anggota'])->filter()->count() < $data['jumlah_cablom']) {
            return back()->withErrors(['jumlah_anggota' => 'Jumlah anggota cabang lomba tidak lengkap']);
        }
        if (collect($data_cablom['biaya'])->filter()->count() < $data['jumlah_cablom']) {
            return back()->withErrors(['biaya' => 'Biaya cabang lomba tidak lengkap']);
        }

        $pamflet_perlombaan = $lomba->pamflet_perlombaan;
        if ($request->file('pamflet_perlombaan')) {
            $extension = $request->file('pamflet_perlombaan')->getClientOriginalExtension();
            $fileName = time().".$extension";
            $path = $request->file('pamflet_perlombaan')->storeAs('pamflet-lomba', $fileName, 'public');
            $pamflet_perlombaan = asset('storage/pamflet-lomba/'.$fileName);
        }
        $lomba->update([
            'nama_perlombaan' => $data['nama_perlombaan'],
            'tempat_perlombaan' => $data['tempat_perlombaan'],
            'deskripsi' => $data['deskripsi'],
            'tanggal_mulai' => $data['tanggal_mulai'],
            'tanggal_selesai' => $data['tanggal_selesai'],
            'pamflet_perlombaan' => $pamflet_perlombaan,
            'rekening' => $data['rekening'],
        ]);
        $lomba->jenis_perlombaan()->sync($data['kategori']);
        CabangLomba::where('id_lomba', $lomba->id_lomba)->delete();
        for ($i=0; $i < $data['jumlah_cablom']; $i++) { 
            $cablom = $lomba->cabang_lomba()->create([
                'nama_cablom' => $data['nama_cablom'][$i],
                'jumlah_anggota' => $data['jumlah_anggota'][$i],
                'biaya' => $data['biaya'][$i],
            ]);
            $cablom->tingkatan()->attach($data['tingkatan'][$i]);
        }
        return redirect('/dashboard/lomba')->with('alert', ['title' => 'Lomba berhasil diubah.', 'type' => 'success']);
    }
    
    public function delete($id)
    {
        Lomba::destroy($id);
        return redirect('/dashboard/lomba')->with('alert', ['title' => 'Lomba berhasil dihapus.', 'type' => 'success']);
    }
}
