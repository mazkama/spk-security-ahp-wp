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
        // Ambil bobot kriteria
        $bobot = BobotKriteria::with('kriteria')->get()->pluck('bobot','kriteria_id');
        // Ambil semua kandidat pada periode
        $kandidat = Kandidat::where('periode_id', $periodeId)->get();
        $nilaiS = [];
        $nilaiV = [];
        $totalS = 0;
        // Hitung nilai S untuk setiap kandidat
        foreach ($kandidat as $k) {
            $penilaian = Penilaian::where('kandidat_id', $k->id)->get();
            $S = 1;
            foreach ($penilaian as $p) {
                $b = $bobot[$p->kriteria_id] ?? 0;
                $S *= pow($p->nilai, $b);
            }
            $nilaiS[$k->id] = $S;
            $totalS += $S;
        }
        // Hitung nilai V (normalisasi)
        foreach ($nilaiS as $id => $S) {
            $nilaiV[$id] = $totalS > 0 ? $S / $totalS : 0;
        }
        // Ranking
        arsort($nilaiV);
        $rank = 1;
        foreach ($nilaiV as $kandidatId => $v) {
            HasilWp::updateOrCreate(
                ['kandidat_id' => $kandidatId],
                [
                    'nilai_s' => $nilaiS[$kandidatId],
                    'nilai_v' => $v,
                    'ranking' => $rank++
                ]
            );
        }
        return $nilaiV;
    }
}
