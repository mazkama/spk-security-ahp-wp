<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KandidatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $periode = \App\Models\Periode::first();
        \App\Models\Kandidat::insert([
            ['nama' => 'Budi', 'periode_id' => $periode->id],
            ['nama' => 'Andi', 'periode_id' => $periode->id],
            ['nama' => 'Siti', 'periode_id' => $periode->id],
        ]);
    }
}
