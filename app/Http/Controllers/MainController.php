<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Lomba;
use App\Models\Tingkatan;
use Illuminate\Http\Request;
use App\Models\JenisPerlombaan;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\LombaResource;

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
            return back(403);
        }
        $lomba = new LombaResource($lomba);
        return Inertia::render('DetailLomba', ['lomba' => $lomba]);
    }
}
