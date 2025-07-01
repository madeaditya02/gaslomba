<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'akun', $primaryKey = 'id_akun';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    protected $with = ['peserta', 'penyelenggara'];

    /**
     * Get the peserta associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function peserta()
    {
        return $this->hasOne(Peserta::class, 'id_akun', 'id_akun');
    }
    
    /**
     * Get the penyelenggara associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function penyelenggara()
    {
        return $this->hasOne(Penyelenggara::class, 'id_akun', 'id_akun');
    }
}
