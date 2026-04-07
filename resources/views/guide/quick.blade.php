@extends('layouts.app')

@section('title', 'Panduan Memulai Kembali')

@section('content')
<div class="max-w-4xl mx-auto space-y-12 animate-fade-in py-8">
    <!-- Header Section -->
    <div class="text-center space-y-4">
        <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-primary-50 border border-primary-100 text-primary-600 text-[10px] font-black uppercase tracking-[0.2em] shadow-sm">
            🚀 Sistem Berhasil Di-Reset
        </div>
        <h1 class="text-4xl font-black text-slate-800 uppercase tracking-tighter leading-none">Apa Langkah Selanjutnya?</h1>
        <p class="text-sm text-slate-500 font-medium max-w-xl mx-auto uppercase tracking-wide">Ikuti panduan 6 langkah cepat ini untuk mulai melakukan seleksi petugas keamanan baru.</p>
    </div>

    <!-- Stepper Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Step 1 -->
        <div class="group relative p-8 rounded-[2rem] bg-white border border-slate-100 shadow-xl hover:shadow-2xl hover:border-primary-100 transition-all duration-500">
            <div class="absolute -top-4 -left-4 w-12 h-12 bg-primary-600 text-white rounded-2xl flex items-center justify-center font-black shadow-lg shadow-primary-600/30 group-hover:scale-110 transition-transform">1</div>
            <div class="space-y-4">
                <div class="p-3 bg-primary-50 text-primary-600 rounded-2xl w-fit">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-800 tracking-tight">Buat Periode Seleksi</h3>
                <p class="text-sm text-slate-500 leading-relaxed">Tentukan periode seleksi aktif sebagai langkah pertama untuk memulai proses rekrutmen petugas keamanan.</p>
                <a href="{{ route('periode.create') }}" class="inline-flex items-center gap-2 text-sm font-bold text-primary-600 hover:gap-4 transition-all uppercase tracking-widest">
                    Buka Menu Periode →
                </a>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="group relative p-8 rounded-[2rem] bg-white border border-slate-100 shadow-xl hover:shadow-2xl hover:border-indigo-100 transition-all duration-500">
            <div class="absolute -top-4 -left-4 w-12 h-12 bg-indigo-600 text-white rounded-2xl flex items-center justify-center font-black shadow-lg shadow-indigo-600/30 group-hover:scale-110 transition-transform">2</div>
            <div class="space-y-4">
                <div class="p-3 bg-indigo-50 text-indigo-600 rounded-2xl w-fit">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-800 tracking-tight">Atur Kriteria & Tipe</h3>
                <p class="text-sm text-slate-500 leading-relaxed">Tentukan indikator penilaian. Pastikan untuk memilih tipe Benefit atau Cost sesuai dengan kebutuhan seleksi.</p>
                <a href="{{ route('kriteria.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-indigo-600 hover:gap-4 transition-all uppercase tracking-widest">
                    Atur Kriteria →
                </a>
            </div>
        </div>

        <!-- Step 3 -->
        <div class="group relative p-8 rounded-[2rem] bg-white border border-slate-100 shadow-xl hover:shadow-2xl hover:border-emerald-100 transition-all duration-500">
            <div class="absolute -top-4 -left-4 w-12 h-12 bg-emerald-600 text-white rounded-2xl flex items-center justify-center font-black shadow-lg shadow-emerald-600/30 group-hover:scale-110 transition-transform">3</div>
            <div class="space-y-4">
                <div class="p-3 bg-emerald-50 text-emerald-600 rounded-2xl w-fit">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-800 tracking-tight">Hirarki Bobot (AHP)</h3>
                <p class="text-sm text-slate-500 leading-relaxed">Tentukan tingkat prioritas antar kriteria menggunakan kuesioner matriks perbandingan berpasangan.</p>
                <a href="{{ route('perbandingan-kriteria.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-emerald-600 hover:gap-4 transition-all uppercase tracking-widest">
                    Hitung AHP →
                </a>
            </div>
        </div>

        <!-- Step 4 -->
        <div class="group relative p-8 rounded-[2rem] bg-white border border-slate-100 shadow-xl hover:shadow-2xl hover:border-amber-100 transition-all duration-500">
            <div class="absolute -top-4 -left-4 w-12 h-12 bg-amber-600 text-white rounded-2xl flex items-center justify-center font-black shadow-lg shadow-amber-600/30 group-hover:scale-110 transition-transform">4</div>
            <div class="space-y-4">
                <div class="p-3 bg-amber-50 text-amber-600 rounded-2xl w-fit">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-800 tracking-tight">Daftarkan Kandidat</h3>
                <p class="text-sm text-slate-500 leading-relaxed">Masukkan data lengkap calon petugas keamanan yang mengikuti seleksi pada periode aktif saat ini.</p>
                <a href="{{ route('kandidat.create') }}" class="inline-flex items-center gap-2 text-sm font-bold text-amber-600 hover:gap-4 transition-all uppercase tracking-widest">
                    Input Kandidat →
                </a>
            </div>
        </div>

        <!-- Step 5 -->
        <div class="group relative p-8 rounded-[2rem] bg-white border border-slate-100 shadow-xl hover:shadow-2xl hover:border-rose-100 transition-all duration-500">
            <div class="absolute -top-4 -left-4 w-12 h-12 bg-rose-600 text-white rounded-2xl flex items-center justify-center font-black shadow-lg shadow-rose-600/30 group-hover:scale-110 transition-transform">5</div>
            <div class="space-y-4">
                <div class="p-3 bg-rose-50 text-rose-600 rounded-2xl w-fit">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-800 tracking-tight">Berikan Penilaian</h3>
                <p class="text-sm text-slate-500 leading-relaxed">Berikan skor (1-100) untuk masing-masing kandidat pada kriteria yang telah ditentukan sebelumnya.</p>
                <a href="{{ route('penilaian.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-rose-600 hover:gap-4 transition-all uppercase tracking-widest">
                    Input Nilai →
                </a>
            </div>
        </div>

        <!-- Step 6 -->
        <div class="group relative p-8 rounded-[2rem] bg-white border border-slate-100 shadow-xl hover:shadow-2xl hover:border-slate-800 transition-all duration-500">
            <div class="absolute -top-4 -left-4 w-12 h-12 bg-slate-900 text-white rounded-2xl flex items-center justify-center font-black shadow-lg shadow-slate-900/40 group-hover:scale-110 transition-transform">6</div>
            <div class="space-y-4">
                <div class="p-3 bg-slate-100 text-slate-900 rounded-2xl w-fit">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-800 tracking-tight">Hasil Ranking (WP)</h3>
                <p class="text-sm text-slate-500 leading-relaxed">Terakhir, sistem akan melakukan perhitungan otomatis Weighted Product untuk menampilkan ranking terbaik.</p>
                <a href="{{ route('hasil-ranking.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-900 hover:gap-4 transition-all uppercase tracking-widest">
                    Lihat Ranking →
                </a>
            </div>
        </div>
    </div>

    <!-- Info Footer / Tips -->
    <div class="p-8 rounded-[2rem] bg-slate-50 border border-slate-100 text-slate-600 text-sm shadow-inner text-center italic relative overflow-hidden group">
        <div class="relative z-10">
            <span class="text-primary-600 font-bold not-italic group-hover:animate-bounce inline-block">💡 Tips:</span> 
            Pastikan Anda telah membuat periode seleksi baru (Step 1) agar menu penginputan data lainnya dapat diakses dengan benar.
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-primary-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
    </div>
</div>
@endsection
