<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Kriteria::insert([
            ['nama' => 'Pengalaman', 'tipe' => 'benefit'],
            ['nama' => 'Usia', 'tipe' => 'cost'],
            ['nama' => 'Kesehatan', 'tipe' => 'benefit'],
        ]);
    }
}
