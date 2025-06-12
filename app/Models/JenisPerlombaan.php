<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisPerlombaan extends Model
{
    protected $table = 'jenis_perlombaan', $primaryKey = 'id_kategori', $keyType = 'string', $guarded = [];
    public $incrementing = false;

    /**
     * The lomba that belong to the JenisPerlombaan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function lomba()
    {
        return $this->belongsToMany(Lomba::class, 'kategori_lomba', 'id_kategori', 'id_lomba');
    }
}
