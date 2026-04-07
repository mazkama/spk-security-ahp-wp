<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kandidat;
use App\Models\Periode;

class KandidatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kandidat = Kandidat::with('periode')->get();
        $periodeCount = Periode::count();
        return view('kandidat.index', compact('kandidat', 'periodeCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $periode = Periode::where('status', '!=', 'selesai')->get();
        
        if ($periode->isEmpty()) {
            return redirect()->route('periode.index')->with('warning', 'Silakan buat periode seleksi terlebih dahulu sebelum menambahkan kandidat.');
        }

        return view('kandidat.create', compact('periode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'periode_id' => 'required|exists:periode,id',
        ]);

        $periode = Periode::findOrFail($request->periode_id);
        if ($periode->status == 'selesai') {
            return redirect()->back()->with('error', 'Tidak dapat menambah kandidat pada periode yang telah dikunci.');
        }

        Kandidat::create($request->all());

        return redirect()->route('kandidat.index')->with('success', 'Kandidat berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kandidat = Kandidat::findOrFail($id);
        $periode = Periode::all();
        return view('kandidat.edit', compact('kandidat', 'periode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'periode_id' => 'required|exists:periode,id',
        ]);

        $kandidat = Kandidat::findOrFail($id);
        
        // Cek apakah periode lama dikunci
        if ($kandidat->periode->status == 'selesai') {
            return redirect()->back()->with('error', 'Tidak dapat mengubah data kandidat pada periode yang telah dikunci.');
        }

        // Cek apakah periode baru dikunci
        $periodeBaru = Periode::findOrFail($request->periode_id);
        if ($periodeBaru->status == 'selesai') {
            return redirect()->back()->with('error', 'Tidak dapat memindahkan kandidat ke periode yang telah dikunci.');
        }

        $kandidat->update($request->all());

        return redirect()->route('kandidat.index')->with('success', 'Kandidat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kandidat = Kandidat::findOrFail($id);
        
        if ($kandidat->periode->status == 'selesai') {
            return redirect()->back()->with('error', 'Tidak dapat menghapus kandidat dari periode yang telah dikunci.');
        }

        $kandidat->delete();

        return redirect()->route('kandidat.index')->with('success', 'Kandidat berhasil dihapus.');
    }
}
