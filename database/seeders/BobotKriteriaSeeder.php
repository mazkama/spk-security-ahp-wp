<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BobotKriteriaSeeder extends Seeder
{
    public function run(): void
    {
        $kriteria = \App\Models\Kriteria::all();
        foreach ($kriteria as $k) {
            \App\Models\BobotKriteria::create([
                'kriteria_id' => $k->id,
                'bobot' => 0.33
            ]);
        }
    }
}