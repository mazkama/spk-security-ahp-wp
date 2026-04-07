<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periode;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $periodes = Periode::withCount('kandidat')->orderByDesc('id')->get();
        return view('periode.index', compact('periodes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('periode.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_periode' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);
        
        Periode::create([
            'nama_periode' => $request->nama_periode,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => 'draft',
        ]);
        
        return redirect()->route('periode.index')->with('success', 'Periode berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $periode = Periode::findOrFail($id);
        return view('periode.show', compact('periode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $periode = Periode::findOrFail($id);
        
        if ($periode->status == 'selesai') {
            return redirect()->route('periode.index')->with('error', 'Periode yang sudah selesai tidak dapat diedit.');
        }

        return view('periode.edit', compact('periode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_periode' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $periode = Periode::findOrFail($id);

        if ($periode->status == 'selesai') {
            return redirect()->route('periode.index')->with('error', 'Periode yang sudah selesai tidak dapat diubah.');
        }

        $periode->update($request->only(['nama_periode', 'tanggal_mulai', 'tanggal_selesai']));

        return redirect()->route('periode.index')->with('success', 'Periode berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $periode = Periode::withCount('kandidat')->findOrFail($id);

        if ($periode->status == 'selesai') {
            return redirect()->route('periode.index')->with('error', 'Periode yang sudah selesai tidak dapat dihapus.');
        }

        if ($periode->kandidat_count > 0) {
            return redirect()->route('periode.index')->with('error', 'Tidak dapat menghapus periode yang sudah memiliki kandidat. Hapus kandidat terlebih dahulu.');
        }

        $periode->delete();

        return redirect()->route('periode.index')->with('success', 'Periode berhasil dihapus');
    }

    public function setAktif($id)
    {
        // Set semua periode ke non-aktif
        Periode::where('status', 'aktif')->update(['status' => 'draft']);
        
        // Set periode ini ke aktif
        $periode = Periode::findOrFail($id);
        $periode->status = 'aktif';
        $periode->save();
        
        return redirect()->route('periode.index')->with('success', 'Periode di-set aktif');
    }

    public function lock($id)
    {
        $periode = Periode::findOrFail($id);
        $periode->status = 'selesai';
        $periode->save();
        
        return redirect()->route('periode.index')->with('success', 'Periode dikunci (selesai)');
    }
}
