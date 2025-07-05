<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PesertaResource extends JsonResource
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
            'id_peserta' => $this->id_peserta,
            'nama' => $this->nama,
            'email' => $this->user->email,
            'tingkatan' => $this->tingkatan,
            'kode_identitas' => $this->kode_identitas,
            'no_telepon' => $this->no_telepon,
            'asal_instansi' => $this->asal_instansi,
            'profile_picture' => $this->profile_picture,
        ];
    }
}
