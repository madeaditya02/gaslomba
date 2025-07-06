<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PenyelenggaraResource extends JsonResource
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
            'id_penyelenggara' => $this->id_penyelenggara,
            'nama_penyelenggara' => $this->nama_penyelenggara,
            'alamat' => $this->alamat,
            'nomor_telepon' => $this->nomor_telepon,
            'asal_instansi' => $this->asal_instansi,
            'provinsi' => $this->provinsi,
            'profile_picture' => $this->profile_picture,
            'email' => $this->user->email,
        ];
    }
}
