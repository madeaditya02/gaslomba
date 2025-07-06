<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lomba extends Model
{
    /** @use HasFactory<\Database\Factories\LombaFactory> */
    use HasFactory;

    protected $table = 'lomba', $primaryKey = 'id_lomba', $guarded = [];

    /**
     * Get the penyelenggara that owns the Lomba
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function penyelenggara()
    {
        return $this->belongsTo(Penyelenggara::class, 'id_penyelenggara', 'id_penyelenggara');
    }

    /**
     * The jenis_perlombaan that belong to the Lomba
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function jenis_perlombaan()
    {
        return $this->belongsToMany(JenisPerlombaan::class, 'kategori_lomba', 'id_lomba', 'id_kategori');
    }

    /**
     * Get all of the cabang_lomba for the Lomba
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cabang_lomba()
    {
        return $this->hasMany(CabangLomba::class, 'id_lomba', 'id_lomba');
    }

    protected function casts(): array
    {
        return [
            'tanggal_mulai' => 'datetime',
            'tanggal_selesai' => 'datetime',
        ];
    }
}
