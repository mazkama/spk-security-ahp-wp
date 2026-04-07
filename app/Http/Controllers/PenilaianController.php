<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kandidat;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Periode;

class PenilaianController extends Controller
{
    public function index()
    {
        $periode = Periode::all();
        $activePeriodeId = request('periode_id', $periode->first()->id ?? null);
        
        $kriterias = Kriteria::all();
        $kandidats = Kandidat::where('periode_id', $activePeriodeId)->get();
        
        // Map scores for easy access: [kandidat_id][kriteria_id] = nilai
        $penilaians = Penilaian::whereIn('kandidat_id', $kandidats->pluck('id'))
            ->get()
            ->groupBy('kandidat_id')
            ->map(function($items) {
                return $items->keyBy('kriteria_id');
            });

        return view('penilaian.index', compact('periode', 'activePeriodeId', 'kriterias', 'kandidats', 'penilaians'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'periode_id' => 'required|exists:periode,id',
            'nilai' => 'required|array',
            'nilai.*' => 'required|array',
            'nilai.*.*' => 'required|numeric|min:0|max:100',
        ]);

        $periode = Periode::findOrFail($request->periode_id);
        if ($periode->status == 'selesai') {
            return redirect()->back()->with('error', 'Tidak dapat menyimpan penilaian pada periode yang telah dikunci.');
        }

        foreach ($request->nilai as $kandidatId => $kriterias) {
            foreach ($kriterias as $kriteriaId => $nilai) {
                Penilaian::updateOrCreate(
                    ['kandidat_id' => $kandidatId, 'kriteria_id' => $kriteriaId],
                    ['nilai' => $nilai]
                );
            }
        }

        return redirect()->back()->with('success', 'Penilaian berhasil disimpan!');
    }
}
