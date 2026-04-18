<?php

namespace App\Services;

use App\Models\BobotKriteria;
use App\Models\Penilaian;
use App\Models\HasilWp;
use App\Models\Kandidat;

class WPService
{
    public function hitungWP($periodeId)
    {
        // 1. Ambil kriteria dan bobotnya
        $bobotKriteria = BobotKriteria::with('kriteria')->get();
        
        if ($bobotKriteria->isEmpty()) {
            return [];
        }

        // 2. Hitung Total Bobot untuk Normalisasi
        $totalBobotRaw = $bobotKriteria->sum('bobot');
        $normalizedWeights = [];
        
        foreach ($bobotKriteria as $bk) {
            // w_j = w_j / sum(w)
            $w = $totalBobotRaw > 0 ? $bk->bobot / $totalBobotRaw : 0;
            
            // Jika kriteria bertipe cost, maka bobot bersifat negatif
            if ($bk->kriteria && $bk->kriteria->tipe == 'cost') {
                $w = -$w;
            }
            
            $normalizedWeights[$bk->kriteria_id] = $w;
        }

        // 3. Ambil data kandidat dan penilaiannya
        $kandidats = Kandidat::where('periode_id', $periodeId)->get();
        if ($kandidats->isEmpty()) {
            return [];
        }

        $kandidatIds = $kandidats->pluck('id');
        $penilaians = Penilaian::whereIn('kandidat_id', $kandidatIds)
            ->get()
            ->groupBy('kandidat_id');

        $nilaiS = [];
        $totalS = 0;

        // 4. Hitung Nilai Vektor S untuk setiap kandidat
        foreach ($kandidats as $k) {
            $penilaianKandidat = $penilaians->get($k->id, collect())->keyBy('kriteria_id');
            $S = 1;
            
            foreach ($normalizedWeights as $kriteriaId => $w) {
                // S_i = product(x_ij ^ w_j)
                $nilai_data = $penilaianKandidat->has($kriteriaId) ? $penilaianKandidat->get($kriteriaId)->nilai : 1;
                $S *= pow($nilai_data, $w);
            }
            
            $nilaiS[$k->id] = $S;
            $totalS += $S;
        }

        // 5. Hitung Nilai Vektor V (Normalisasi Vektor S)
        $results = [];
        foreach ($kandidats as $k) {
            $V = $totalS > 0 ? $nilaiS[$k->id] / $totalS : 0;
            $results[] = [
                'kandidat_id' => $k->id,
                'nilai_s' => $nilaiS[$k->id],
                'nilai_v' => $V,
            ];
        }

        // 6. Urutkan berdasarkan nilai V (Ranking)
        usort($results, function ($a, $b) {
            return $b['nilai_v'] <=> $a['nilai_v'];
        });

        // 7. Simpan ke database
        $rank = 1;
        foreach ($results as $res) {
            HasilWp::updateOrCreate(
                ['kandidat_id' => $res['kandidat_id']],
                [
                    'nilai_s' => $res['nilai_s'],
                    'nilai_v' => $res['nilai_v'],
                    'ranking' => $rank++,
                    'updated_at' => now()
                ]
            );
        }

        return $results;
    }
}
