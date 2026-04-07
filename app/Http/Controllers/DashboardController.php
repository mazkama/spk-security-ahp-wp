<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kandidat;
use App\Models\Kriteria;
use App\Models\Periode;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahKandidat = Kandidat::count();
        $jumlahKriteria = Kriteria::count();
        $periodeAktif = Periode::orderByDesc('id')->first();
        return view('dashboard', [
            'jumlahKandidat' => $jumlahKandidat,
            'jumlahKriteria' => $jumlahKriteria,
            'periodeAktif' => $periodeAktif
        ]);
    }
}
