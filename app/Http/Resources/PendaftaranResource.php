<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PendaftaranResource extends JsonResource
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
            'nama_perlombaan' => $this->cabang_lomba->lomba->nama_perlombaan,
            'tanggal_perlombaan' => [
                $this->cabang_lomba->lomba->tanggal_mulai,
                $this->cabang_lomba->lomba->tanggal_selesai,
            ],
            'tanggal_perlombaan_string' => [
                $this->cabang_lomba->lomba->tanggal_mulai->format('d M Y'),
                $this->cabang_lomba->lomba->tanggal_selesai->format('d M Y'),
            ],
            'id_pendaftaran' => $this->id,
            'cablom' => $this->cabang_lomba->id_cablom,
            'cabang_lomba' => $this->cabang_lomba->nama_cablom,
            'anggota' => $this->whenLoaded('peserta'),
            'status' => $this->status,
            'catatan_panitia' => $this->catatan_panitia,
            'bukti_pembayaran' => $this->bukti_pembayaran,
        ];
    }
}
