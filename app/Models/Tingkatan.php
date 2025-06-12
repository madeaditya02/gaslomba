<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tingkatan extends Model
{
    protected $table = 'tingkatan', $primaryKey = 'id_tingkatan', $keyType = 'string', $guarded = [];
    public $incrementing = false;

    /**
     * The cabang_lomba that belong to the Tingkatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cabang_lomba()
    {
        return $this->belongsToMany(CabangLomba::class, 'tingkatan_cablom', 'id_tingkatan', 'id_cablom');
    }
}
