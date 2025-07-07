<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Peserta;
use App\Models\Tingkatan;
use Illuminate\Http\Request;
use App\Http\Resources\PesertaResource;
use App\Http\Resources\PendaftaranResource;
use App\Http\Resources\PenyelenggaraResource;

class DashboardController extends Controller
{
    public function profile()
    {
        if (auth()->user()->peserta) {
            $peserta = new PesertaResource(auth()->user()->peserta);
            $tingkatan = Tingkatan::all();
            return Inertia::render('ProfilPeserta', [
                'peserta' => $peserta,
                'tingkatan' => $tingkatan,
            ]);
        } else {
            $penyelenggara = new PenyelenggaraResource(auth()->user()->penyelenggara);
            return Inertia::render('admin/Dashboard', ['penyelenggara' => $penyelenggara]);
        }
    }

    public function updateProfile(Request $request) {
        if (auth()->user()->peserta) {
            $data = $request->validate([
                'nama' => ['required'],
                'tingkatan' => ['required', 'exists:tingkatan,id_tingkatan'],
                'kode' => ['required'],
                // 'asal_instansi' => ['required'],
                'nomor_telepon' => ['required'],
            ]);
            $fileName = auth()->user()->peserta->profile_picture;
            if ($request->file('profile_picture')) {
                $extension = $request->file('profile_picture')->getClientOriginalExtension();
                $fileName = auth()->user()->email.".$extension";
                $path = $request->file('profile_picture')->storeAs('profile-picture', $fileName, 'public');
                $fileName = asset('storage/profile-picture/'.$fileName);
            }
            auth()->user()->peserta->update([
                'nama' => $data['nama'],
                'tingkatan' => $data['tingkatan'],
                'kode_identitas' => $data['kode'],
                'no_telepon' => $data['nomor_telepon'],
                'profile_picture' => $fileName,
            ]);
        }
        else {
            $data = $request->validate([
                'nama_penyelenggara' => ['required'],
                'alamat' => ['required'],
                'asal_instansi' => ['required'],
                'nomor_telepon' => ['required'],
            ]);
            $fileName = auth()->user()->penyelenggara->profile_picture;
            if ($request->file('profile_picture')) {
                $extension = $request->file('profile_picture')->getClientOriginalExtension();
                $fileName = auth()->user()->email.".$extension";
                $path = $request->file('profile_picture')->storeAs('profile-picture', $fileName, 'public');
                $fileName = asset('storage/profile-picture/'.$fileName);
            }
            $data = $request->all();
            $data['profile_picture'] = $fileName;
            auth()->user()->penyelenggara->update($data);
        }
        return redirect('/dashboard');
    }
}
