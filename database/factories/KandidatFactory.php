<?php

namespace Database\Factories;

use App\Models\Kandidat;
use Illuminate\Database\Eloquent\Factories\Factory;

class KandidatFactory extends Factory
{
    protected $model = Kandidat::class;

    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'periode_id' => function () {
                return \App\Models\Periode::factory()->create()->id;
            },
        ];
    }
}
