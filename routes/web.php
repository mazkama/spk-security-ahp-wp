
<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\KandidatController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HasilRankingController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\PerbandinganKriteriaController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('landing');
});

Route::get('/landing', [LandingController::class, 'index'])->name('landing');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/hasil-ranking', [HasilRankingController::class, 'index'])->name('hasil-ranking.index');
    
    Route::get('/hasil-ranking/export-pdf', [HasilRankingController::class, 'exportPdf'])->name('hasil-ranking.export-pdf');
    
    Route::resource('kriteria', KriteriaController::class)->except(['show']);
    Route::resource('kandidat', KandidatController::class)->except(['show']);
    Route::resource('penilaian', PenilaianController::class)->except(['show']);
    Route::resource('periode', PeriodeController::class);
    Route::resource('perbandingan-kriteria', PerbandinganKriteriaController::class)->except(['show']);
    
    Route::post('periode/{id}/set-aktif', [PeriodeController::class, 'setAktif'])->name('periode.set-aktif');
    Route::post('periode/{id}/lock', [PeriodeController::class, 'lock'])->name('periode.lock');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile.update');
    Route::post('/settings/reset', [SettingsController::class, 'resetSystem'])->name('settings.reset');
    Route::get('/quick-guide', [GuideController::class, 'index'])->name('guide.quick');
});


require __DIR__.'/auth.php';