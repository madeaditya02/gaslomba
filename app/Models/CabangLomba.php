<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabangLomba extends Model
{
    /** @use HasFactory<\Database\Factories\CabangLombaFactory> */
    use HasFactory;
    protected $table = 'cabang_lomba', $primaryKey = 'id_cablom', $guarded = ['id_cablom'];

    /**
     * Get the lomba that owns the CabangLomba
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lomba()
    {
        return $this->belongsTo(Lomba::class, 'id_lomba', 'id_lomba');
    }

    /**
     * The tingkatan that belong to the CabangLomba
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tingkatan()
    {
        return $this->belongsToMany(tingkatan::class, 'tingkatan_cablom', 'id_cablom', 'id_tingkatan');
    }

    /**
     * Get all of the pendaftaran for the CabangLomba
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'id_cablom', 'id_cablom');
    }
}
