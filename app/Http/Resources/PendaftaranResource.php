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
            'cabang_lomba' => $this->cabang_lomba->nama_cablom,
            'anggota' => PesertaResource::collection($this->peserta()->wherePivot('role', 'Anggota')->get()),
            'status' => $this->status_berkas,
            'catatan_panitia' => $this->catatan_panitia,
            'bukti_pembayaran' => $this->bukti_pembayaran,
        ];
    }
}
