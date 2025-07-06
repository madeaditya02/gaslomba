<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    /** @use HasFactory<\Database\Factories\PesertaFactory> */
    use HasFactory;

    protected $table = 'peserta', $primaryKey = 'id_peserta', $guarded = [];
    protected $with = ['jenjang'];

    /**
     * The pendaftaran that belong to the Peserta
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pendaftaran()
    {
        return $this->belongsToMany(pendaftaran::class, 'peserta_pendaftaran', 'id_peserta', 'id_pendaftaran');
    }

    /**
     * Get the user that owns the Peserta
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_akun', 'id_akun');
    }

    /**
     * Get the tingkatan that owns the Peserta
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jenjang()
    {
        return $this->belongsTo(Tingkatan::class, 'tingkatan', 'id_tingkatan');
    }
}
