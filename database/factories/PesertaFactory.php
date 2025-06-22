<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Peserta>
 */
class PesertaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $listTingkatan = collect(['sma', 'mahasiswa', 'umum']);
        $num = random_int(10,99);
        $tingkatan = $listTingkatan->random();
        return [
            'nama' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'no_telepon' => fake()->phoneNumber(),
            'tingkatan' => $tingkatan,
            'password' => Hash::make('password'),
            'asal_instansi' => $tingkatan == 'sma' ? 'SMA Negeri 1 Denpasar' : ($tingkatan == 'mahasiswa' ? 'Universitas Udayana' : null),
            'kode_identitas' => $tingkatan == 'sma' ? "1211980$num" : ($tingkatan == 'mahasiswa' ? "23085610$num" : fake()->nik())
        ];
    }
}
