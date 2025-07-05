<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyelenggara extends Model
{
    /** @use HasFactory<\Database\Factories\PesertaFactory> */
    use HasFactory;

    protected $table = 'penyelenggara', $primaryKey = 'id_penyelenggara', $guarded = [];

    /**
     * Get all of the lomba for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lomba()
    {
        return $this->hasMany(Lomba::class, 'id_penyelenggara', 'id_penyelenggara');
    }

    /**
     * Get the user that owns the Penyelenggara
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_akun', 'id_akun');
    }
}
