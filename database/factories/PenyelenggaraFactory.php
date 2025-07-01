<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PenyelenggaraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_penyelenggara' => fake()->name(),
            'provinsi' => 'Bali',
            'nomor_telepon' => '08973891362',
            'alamat' => 'Kampus Udayana Bukit Jimbaran',
        ];
    }
}
