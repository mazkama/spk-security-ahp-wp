<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Periode::create([
            'nama_periode' => 'Periode April 2026',
            'tanggal_mulai' => '2026-04-01',
            'tanggal_selesai' => '2026-04-30',
            'status' => 'aktif',
        ]);
        \App\Models\Periode::create([
            'nama_periode' => 'Periode Maret 2026',
            'tanggal_mulai' => '2026-03-01',
            'tanggal_selesai' => '2026-03-31',
            'status' => 'selesai',
        ]);
    }
}
