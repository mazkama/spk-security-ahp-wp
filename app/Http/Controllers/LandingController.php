<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kandidat;
use App\Models\Kriteria;

class LandingController extends Controller
{
    public function index()
    {
        $jumlahKandidat = Kandidat::count();
        $jumlahKriteria = Kriteria::count();
        return view('welcome', compact('jumlahKandidat', 'jumlahKriteria'));
    }
}
