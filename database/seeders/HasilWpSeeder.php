<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HasilWpSeeder extends Seeder
{
    public function run(): void
    {
        $kandidat = \App\Models\Kandidat::first();
        if ($kandidat) {
            \App\Models\HasilWp::create([
                'kandidat_id' => $kandidat->id,
                'nilai_s' => 1.0,
                'nilai_v' => 1.0,
                'ranking' => 1
            ]);
        }
    }
}