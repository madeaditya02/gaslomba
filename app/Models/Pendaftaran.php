<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    /** @use HasFactory<\Database\Factories\PendaftaranFactory> */
    use HasFactory;

    protected $table = 'pendaftaran', $guarded = ['id'];

    /**
     * Get the cabang_lomba that owns the Pendaftaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cabang_lomba()
    {
        return $this->belongsTo(CabangLomba::class, 'id_cablom', 'id_cablom');
    }

    /**
     * The peserta that belong to the Pendaftaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function peserta()
    {
        return $this->belongsToMany(peserta::class, 'peserta_pendaftaran', 'id_pendaftaran', 'id_peserta');
    }
}
