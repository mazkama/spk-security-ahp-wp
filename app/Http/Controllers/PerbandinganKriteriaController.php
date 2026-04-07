<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\BobotKriteria;
use App\Models\PerbandinganKriteria;

class PerbandinganKriteriaController extends Controller
{
    private $random_index = [
        1 => 0.00,
        2 => 0.00,
        3 => 0.58,
        4 => 0.90,
        5 => 1.12,
        6 => 1.24,
        7 => 1.32,
        8 => 1.41,
        9 => 1.45,
        10 => 1.49
    ];

    public function index()
    {
        $kriteria = Kriteria::all();
        $n = $kriteria->count();
        
        if ($n < 2) {
            return redirect()->route('kriteria.index')->with('error', 'Minimal harus ada 2 kriteria untuk melakukan perbandingan.');
        }

        // Get existing comparisons
        $comparisons = PerbandinganKriteria::all()->keyBy(function($item) {
            return $item->kriteria_1_id . '-' . $item->kriteria_2_id;
        });

        $bobot = BobotKriteria::with('kriteria')->get();

        return view('perbandingan_kriteria.index', compact('kriteria', 'comparisons', 'bobot'));
    }

    public function store(Request $request)
    {
        $kriteria = Kriteria::all();
        $n = $kriteria->count();
        $ids = $kriteria->pluck('id')->toArray();

        // 1. Build Comparison Matrix A
        $matrix = [];
        // Preset diagonal and reciprocity
        foreach ($ids as $i) {
            $matrix[$i][$i] = 1.0;
        }

        foreach ($request->input('nilai', []) as $pair => $value) {
            list($id1, $id2) = explode('-', $pair);
            $val = (float)$value;
            
            // value interpretation: 
            // positive -> id1 is 'val' times more important than id2
            // negative -> id2 is 'abs(val)' times more important than id1
            if ($val > 0) {
                $matrix[$id1][$id2] = $val;
                $matrix[$id2][$id1] = 1 / $val;
            } else {
                $realVal = abs($val);
                $matrix[$id1][$id2] = 1 / $realVal;
                $matrix[$id2][$id1] = $realVal;
            }

            // Save comparison for later editing
            PerbandinganKriteria::updateOrCreate(
                ['kriteria_1_id' => $id1, 'kriteria_2_id' => $id2],
                ['nilai' => $val]
            );
        }

        // 2. Calculate Column Sums
        $colSums = [];
        foreach ($ids as $j) {
            $colSum = 0;
            foreach ($ids as $i) {
                $colSum += $matrix[$i][$j];
            }
            $colSums[$j] = $colSum;
        }

        // 3. Normalize & Calculate Weights (Priority Vector)
        $weights = [];
        foreach ($ids as $i) {
            $rowSum = 0;
            foreach ($ids as $j) {
                $rowSum += ($matrix[$i][$j] / $colSums[$j]);
            }
            $weights[$i] = $rowSum / $n;
        }

        // 4. Calculate Consistency
        $lambdaMax = 0;
        foreach ($ids as $j) {
            $lambdaMax += ($colSums[$j] * $weights[$j]);
        }

        $ci = ($n > 1) ? ($lambdaMax - $n) / ($n - 1) : 0;
        $ri = $this->random_index[$n] ?? 1.49;
        $cr = ($ri > 0) ? $ci / $ri : 0;

        if ($cr > 0.1) {
            return redirect()->back()->withInput()->with('error', sprintf('Matriks tidak konsisten! Rasio Konsistensi (CR): %.4f (> 0.1). Silakan perbaiki nilai perbandingan.', $cr));
        }

        // 5. Save Weights
        foreach ($weights as $id => $weight) {
            BobotKriteria::updateOrCreate(
                ['kriteria_id' => $id],
                ['bobot' => $weight]
            );
        }

        return redirect()->route('perbandingan-kriteria.index')->with('success', sprintf('Bobot kriteria berhasil dihitung! Rasio Konsistensi (CR): %.4f (Konsisten).', $cr));
    }
}
