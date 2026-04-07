<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\HasilWp;
use App\Models\Kandidat;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\BobotKriteria;
use App\Models\Periode;
use Barryvdh\DomPDF\Facade\Pdf;

class HasilRankingController extends Controller
{
    public function index()
    {
        $periode = Periode::all();
        $activePeriodeId = request('periode_id', Periode::where('status', 'aktif')->first()->id ?? $periode->first()->id ?? null);
        
        $activePeriode = Periode::find($activePeriodeId);

        // Hanya hitung ulang jika periode TIDAK selesai, atau jika data ranking kosong
        $exists = HasilWp::whereHas('kandidat', function($q) use ($activePeriodeId) {
            $q->where('periode_id', $activePeriodeId);
        })->exists();

        if ($activePeriode && ($activePeriode->status != 'selesai' || !$exists)) {
            $this->calculate($activePeriodeId);
        }
        
        $hasil = HasilWp::with('kandidat')
            ->whereHas('kandidat', function($q) use ($activePeriodeId) {
                $q->where('periode_id', $activePeriodeId);
            })
            ->orderBy('ranking')
            ->get();

        return view('hasil_ranking', [
            'hasil' => $hasil,
            'periode' => $periode,
            'activePeriodeId' => $activePeriodeId,
            'activePeriode' => $activePeriode
        ]);
    }

    private function calculate($periodeId)
    {
        $kriterias = Kriteria::all();
        $kandidats = Kandidat::where('periode_id', $periodeId)->get();
        $weights = BobotKriteria::all()->keyBy('kriteria_id');
        
        if ($kriterias->isEmpty() || $kandidats->isEmpty() || $weights->isEmpty()) {
            return;
        }

        // 1. Collect Scores Matrix
        $penilaians = Penilaian::whereIn('kandidat_id', $kandidats->pluck('id'))
            ->get()
            ->groupBy('kandidat_id')
            ->map(function($items) {
                return $items->keyBy('kriteria_id');
            });

        // 2. WP Calculation
        $vectorsS = [];
        $sumS = 0;

        foreach ($kandidats as $kandidat) {
            $s = 1;
            foreach ($kriterias as $kriteria) {
                $score = $penilaians->has($kandidat->id) && $penilaians[$kandidat->id]->has($kriteria->id)
                    ? $penilaians[$kandidat->id][$kriteria->id]->nilai
                    : 1;

                $w = isset($weights[$kriteria->id]) ? $weights[$kriteria->id]->bobot : 0;
                
                if ($kriteria->tipe == 'cost') {
                    $w = -$w;
                }

                $s *= pow($score, $w);
            }
            $vectorsS[$kandidat->id] = $s;
            $sumS += $s;
        }

        // 3. Normalize & Store - Filter only for this period
        HasilWp::whereHas('kandidat', function($q) use ($periodeId) {
            $q->where('periode_id', $periodeId);
        })->delete();

        $results = [];
        foreach ($kandidats as $kandidat) {
            $v = ($sumS > 0) ? $vectorsS[$kandidat->id] / $sumS : 0;
            $results[] = [
                'kandidat_id' => $kandidat->id,
                'nilai_s' => $vectorsS[$kandidat->id],
                'nilai_v' => $v,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        usort($results, function($a, $b) {
            return $b['nilai_v'] <=> $a['nilai_v'];
        });

        foreach ($results as $index => &$res) {
            $res['ranking'] = $index + 1;
        }

        HasilWp::insert($results);
    }

    public function exportPdf()
    {
        $activePeriodeId = request('periode_id');
        $kandidat = Kandidat::where('periode_id', $activePeriodeId)->get();
        $bobot = BobotKriteria::with('kriteria')->get();
        $hasil = HasilWp::with('kandidat')
            ->whereHas('kandidat', function($q) use ($activePeriodeId) {
                $q->where('periode_id', $activePeriodeId);
            })
            ->orderBy('ranking')
            ->get();
        
        $periode = Periode::find($activePeriodeId);
        
        $pdf = Pdf::loadView('export_laporan', [
            'kandidat' => $kandidat,
            'bobot' => $bobot,
            'hasil' => $hasil,
            'periode' => $periode
        ]);
        
        return $pdf->download('laporan_spk_security_' . ($periode->nama_periode ?? 'export') . '.pdf');
    }
}
