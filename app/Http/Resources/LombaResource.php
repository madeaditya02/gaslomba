<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LombaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id_lomba' => $this->id_lomba,
            'nama_perlombaan' => $this->nama_perlombaan,
            'tempat_perlombaan' => $this->tempat_perlombaan,
            'pamflet_perlombaan' => $this->pamflet_perlombaan,
            'nama_penyelenggara' => $this->penyelenggara->nama_penyelenggara,
            'cabang_lomba' => $this->cabang_lomba->select(['id_cablom', 'nama_cablom', 'jumlah_anggota', 'biaya']),
            'range_harga' => [
                $this->cabang_lomba->pluck('biaya')->min(),
                $this->cabang_lomba->pluck('biaya')->max(),
            ],
            'is_active' => $this->tanggal_mulai <= today() && $this->tanggal_selesai >= today(),
            'tingkatan' => $this->cabang_lomba->pluck('tingkatan')->flatten()->unique('id_tingkatan')->values()->select(['id_tingkatan','nama_tingkatan']),
            'kategori' => $this->jenis_perlombaan->select(['id_kategori', 'nama_kategori']),
            'deskripsi' => $this->deskripsi,
            'rekening' => $this->rekening,
            // 'peserta' => $this->cabang_lomba->pluck('peserta')
        ];
    }
}
