<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.index', [
            'user' => Auth::user()
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini tidak cocok.']);
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function resetSystem(Request $request)
    {
        $request->validate([
            'confirmation' => 'required|string|in:RESET SISTEM',
        ]);

        try {
            // NOTE: TRUNCATE is DDL and causes implicit commit in MySQL, 
            // so we don't use typical DB transactions here.
            
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            
            DB::table('hasil_wp')->truncate();
            DB::table('penilaian')->truncate();
            DB::table('bobot_kriteria')->truncate();
            DB::table('perbandingan_kriteria')->truncate();
            DB::table('kandidat')->truncate();
            DB::table('kriteria')->truncate();
            DB::table('periode')->truncate();

            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            return redirect()->route('guide.quick')->with('success', 'Sistem berhasil di-reset. Semua data telah dibersihkan.');
        } catch (\Exception $e) {
            // Ensure checks are re-enabled even on failure
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return back()->with('error', 'Gagal mereset sistem: ' . $e->getMessage());
        }
    }
}
