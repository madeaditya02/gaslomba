<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    /** @use HasFactory<\Database\Factories\PesertaFactory> */
    use HasFactory;

    protected $table = 'peserta', $primaryKey = 'id_peserta', $guarded = [];

    /**
     * The pendaftaran that belong to the Peserta
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pendaftaran()
    {
        return $this->belongsToMany(pendaftaran::class, 'peserta_pendaftaran', 'id_peserta', 'id_pendaftaran');
    }
}
