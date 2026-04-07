<?php

namespace Database\Factories;

use App\Models\Periode;
use Illuminate\Database\Eloquent\Factories\Factory;

class PeriodeFactory extends Factory
{
    protected $model = Periode::class;

    public function definition(): array
    {
        return [
            'nama_periode' => 'Periode ' . $this->faker->unique()->word(),
            'tanggal_mulai' => $this->faker->date(),
            'tanggal_selesai' => $this->faker->date(),
            'status' => $this->faker->randomElement(['aktif', 'selesai', 'draft']),
        ];
    }
}
