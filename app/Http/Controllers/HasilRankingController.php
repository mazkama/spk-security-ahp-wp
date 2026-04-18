<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\HasilWp;
use App\Models\Kandidat;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\BobotKriteria;
use App\Models\Periode;
use App\Services\WPService;
use Barryvdh\DomPDF\Facade\Pdf;

class HasilRankingController extends Controller
{
    protected $wpService;

    public function __construct(WPService $wpService)
    {
        $this->wpService = $wpService;
    }

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
            $this->wpService->hitungWP($activePeriodeId);
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
