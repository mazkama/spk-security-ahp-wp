@php
    $wideContainer = true;
@endphp

@extends('layouts.guest')

@section('title', 'Pusat Komando Keamanan - Sistem Rekrutmen SPK')

@section('content')
<div class="w-full max-w-6xl mx-auto px-10 space-y-24 py-16">
    <!-- BAGIAN HERO -->
    <section class="flex flex-col lg:flex-row items-center gap-16 min-h-[70vh]">
        <div class="flex-1 space-y-8 animate-fade-in-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary-100/50 border border-primary-200 text-primary-700 text-xs font-bold uppercase tracking-widest">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-primary-500"></span>
                </span>
                SPK Standar Industri
            </div>
            
            <h1 class="text-6xl lg:text-6xl font-black text-slate-800 tracking-tighter leading-[0.9] uppercase">
                Integritas di <span class="bg-gradient-to-r from-primary-600 to-indigo-600 bg-clip-text text-transparent">Setiap Lencana</span>
            </h1>
            
            <p class="text-xl text-slate-500 leading-relaxed font-medium max-w-2xl">
                Sistem Pendukung Keputusan rekrutmen petugas keamanan berbasis cerdas. Menggabungkan objektivitas data dengan kemudahan operasional untuk hasil yang transparan.
            </p>
            
            <div class="flex flex-wrap gap-4 pt-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-premium bg-primary-600 text-white hover:bg-primary-700 px-10 py-5 text-lg flex items-center gap-3">
                        Dashboard Utama
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-premium bg-primary-600 text-white hover:bg-primary-700 px-10 py-5 text-lg flex items-center gap-3">
                        Masuk ke Sistem
                    </a>
                    <a href="#fitur" class="px-10 py-5 rounded-2xl font-bold text-slate-600 border-2 border-slate-200 hover:bg-slate-50 transition-all text-lg">
                        Pelajari Fitur
                    </a>
                @endauth
            </div>
        </div>
        
        <div class="flex-1 relative animate-fade-in lg:block hidden">
            <div class="absolute -top-10 -right-10 w-64 h-64 bg-primary-400/20 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute -bottom-10 -left-10 w-48 h-48 bg-indigo-400/20 rounded-full blur-2xl"></div>
            
            <div class="relative z-10 space-y-6">
                <!-- Stat Card 1 -->
                <x-card class="border-white/40 shadow-3xl transform rotate-3 hover:rotate-0 transition-transform duration-700">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-primary-600 flex items-center justify-center text-white shadow-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-black text-slate-800 uppercase tracking-tighter">{{ $jumlahKandidat ?? 0 }} Kandidat Terdaftar</p>
                            <p class="text-[10px] text-slate-500 uppercase font-bold tracking-widest leading-none mt-1">Data Pelamar Aktif</p>
                        </div>
                    </div>
                </x-card>

                <!-- Stat Card 2 -->
                <x-card class="border-white/40 shadow-3xl transform -rotate-2 hover:rotate-0 transition-transform duration-700 ml-12">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-600 flex items-center justify-center text-white shadow-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-black text-slate-800 uppercase tracking-tighter">{{ $jumlahKriteria ?? 0 }} Indikator Kriteria</p>
                            <p class="text-[10px] text-slate-500 uppercase font-bold tracking-widest leading-none mt-1">Basis Penilaian AHP</p>
                        </div>
                    </div>
                </x-card>
            </div>
        </div>
    </section>

    <!-- BAGIAN TEKNOLOGI INTI -->
    <section class="space-y-12">
        <div class="text-center space-y-4">
            <h2 class="text-4xl font-black text-slate-800 uppercase tracking-tighter">Kecerdasan di Balik Keputusan</h2>
            <p class="text-slate-500 max-w-2xl mx-auto font-medium">Sistem kami menggunakan perpaduan dua metode matematis handal untuk menjamin objektivitas mutlak dalam rekrutmen.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <x-card class="bg-gradient-to-br from-white to-primary-50/30 group hover:shadow-2xl transition-all duration-500">
                <div class="flex items-start gap-6">
                    <div class="w-16 h-16 rounded-2xl bg-primary-100 text-primary-600 flex items-center justify-center shrink-0 group-hover:bg-primary-600 group-hover:text-white transition-colors">
                        <span class="text-2xl font-black">AHP</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-slate-800 uppercase tracking-tight">Analytical Hierarchy Process</h3>
                        <p class="text-sm text-slate-500 mt-2 leading-relaxed">Digunakan untuk <b>pembobotan kriteria</b>. Para ahli melakukan perbandingan antar kriteria untuk mendapatkan nilai kepentingan yang paling presisi dan konsisten.</p>
                        <div class="mt-4 flex gap-2">
                            <span class="px-3 py-1 bg-white rounded-lg text-[10px] font-bold text-primary-600 border border-primary-100 uppercase tracking-widest">Matriks Berpasangan</span>
                            <span class="px-3 py-1 bg-white rounded-lg text-[10px] font-bold text-primary-600 border border-primary-100 uppercase tracking-widest">Rasio Konsistensi</span>
                        </div>
                    </div>
                </div>
            </x-card>

            <x-card class="bg-gradient-to-br from-white to-indigo-50/30 group hover:shadow-2xl transition-all duration-500">
                <div class="flex items-start gap-6">
                    <div class="w-16 h-16 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center shrink-0 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                        <span class="text-2xl font-black">WP</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-slate-800 uppercase tracking-tight">Weighted Product Method</h3>
                        <p class="text-sm text-slate-500 mt-2 leading-relaxed">Metode untuk <b>rangkingan kandidat</b>. Mengalikan semua atribut kandidat dengan bobot kriteria untuk menghasilkan nilai preferensi yang akurat.</p>
                        <div class="mt-4 flex gap-2">
                            <span class="px-3 py-1 bg-white rounded-lg text-[10px] font-bold text-indigo-600 border border-indigo-100 uppercase tracking-widest">Vektor S</span>
                            <span class="px-3 py-1 bg-white rounded-lg text-[10px] font-bold text-indigo-600 border border-indigo-100 uppercase tracking-widest">Vektor V</span>
                        </div>
                    </div>
                </div>
            </x-card>
        </div>
    </section>

    <!-- GRID FITUR UTAMA -->
    <section id="fitur" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="p-8 rounded-[2rem] bg-white border border-slate-100 space-y-4 hover:-translate-y-2 transition-transform shadow-sm">
            <div class="w-12 h-12 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
            <h4 class="font-black text-slate-800 uppercase tracking-tight text-lg">Manajemen Periode</h4>
            <p class="text-sm text-slate-500 font-medium">Pengarsipan data seleksi berdasarkan gelombang atau periode waktu secara rapi dan terukur.</p>
        </div>

        <div class="p-8 rounded-[2rem] bg-white border border-slate-100 space-y-4 hover:-translate-y-2 transition-transform shadow-sm">
            <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h4 class="font-black text-slate-800 uppercase tracking-tight text-lg">Penilaian Cerdas</h4>
            <p class="text-sm text-slate-500 font-medium">Input nilai performa kandidat pada setiap kriteria dengan validasi data yang presisi.</p>
        </div>

        <div class="p-8 rounded-[2rem] bg-white border border-slate-100 space-y-4 hover:-translate-y-2 transition-transform shadow-sm">
            <div class="w-12 h-12 rounded-xl bg-primary-100 text-primary-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            </div>
            <h4 class="font-black text-slate-800 uppercase tracking-tight text-lg">Ranking Objektif</h4>
            <p class="text-sm text-slate-500 font-medium">Sistem mengurutkan hasil terbaik secara otomatis tanpa adanya bias penilaian subjektif.</p>
        </div>

        <div class="p-8 rounded-[2rem] bg-white border border-slate-100 space-y-4 hover:-translate-y-2 transition-transform shadow-sm">
            <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <h4 class="font-black text-slate-800 uppercase tracking-tight text-lg">Laporan PDF</h4>
            <p class="text-sm text-slate-500 font-medium">Unduh hasil akhir dalam format PDF profesional untuk keperluan administrasi resmi.</p>
        </div>
    </section>

    <!-- ALUR KERJA / TIMELINE -->
    <section class="p-12 rounded-[3rem] bg-secondary-900 text-white relative overflow-hidden">
        <div class="absolute right-0 top-0 w-96 h-96 bg-primary-600/10 rounded-full blur-3xl"></div>
        
        <div class="relative z-10 space-y-16">
            <div class="text-center">
                <h2 class="text-3xl font-black uppercase tracking-tighter">Alur Kerja Seleksi Cerdas</h2>
                <span class="text-xs font-bold text-secondary-500 uppercase tracking-[0.5em] mt-2 block">4 Langkah Menuju Hasil Objektif</span>
            </div>

            <div class="flex flex-col md:flex-row gap-8 justify-between relative">
                <!-- Langkah 1 -->
                <div class="flex-1 space-y-4 text-center">
                    <div class="w-12 h-12 bg-white/10 rounded-full border border-white/20 flex items-center justify-center mx-auto text-xl font-black text-primary-400">1</div>
                    <h5 class="font-bold text-sm uppercase tracking-widest">Penentuan Kriteria</h5>
                    <p class="text-[10px] text-secondary-400 font-medium uppercase leading-relaxed text-center">Tentukan kriteria penilaian melalui pembobotan AHP.</p>
                </div>
                <!-- Langkah 2 -->
                <div class="flex-1 space-y-4 text-center">
                    <div class="w-12 h-12 bg-white/10 rounded-full border border-white/20 flex items-center justify-center mx-auto text-xl font-black text-primary-400">2</div>
                    <h5 class="font-bold text-sm uppercase tracking-widest">Pendaftaran Kandidat</h5>
                    <p class="text-[10px] text-secondary-400 font-medium uppercase leading-relaxed text-center">Daftarkan peserta pelamar petugas keamanan baru.</p>
                </div>
                <!-- Langkah 3 -->
                <div class="flex-1 space-y-4 text-center">
                    <div class="w-12 h-12 bg-white/10 rounded-full border border-white/20 flex items-center justify-center mx-auto text-xl font-black text-primary-400">3</div>
                    <h5 class="font-bold text-sm uppercase tracking-widest">Penilaian Performa</h5>
                    <p class="text-[10px] text-secondary-400 font-medium uppercase leading-relaxed text-center">Berikan skor penilaian sesuai indikator yang ada.</p>
                </div>
                <!-- Langkah 4 -->
                <div class="flex-1 space-y-4 text-center">
                    <div class="w-12 h-12 bg-primary-600 rounded-full border border-primary-400 flex items-center justify-center mx-auto text-xl font-black text-white shadow-lg shadow-primary-600/40 animate-pulse">4</div>
                    <h5 class="font-bold text-sm uppercase tracking-widest text-primary-400">Hasil Perangkingan</h5>
                    <p class="text-[10px] text-secondary-400 font-medium uppercase leading-relaxed text-center">Dapatkan urutan kandidat terbaik secara instan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- PANGGILAN AKSI -->
    <section class="text-center py-20 bg-primary-600 rounded-[3rem] text-white shadow-3xl shadow-primary-600/20">
        <h2 class="text-4xl lg:text-5xl font-black uppercase tracking-tighter mb-8 text-center">Siap Menyeleksi Secara Objektif?</h2>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
             @auth
                <a href="{{ url('/dashboard') }}" class="px-10 py-5 bg-white text-primary-600 rounded-2xl font-black uppercase tracking-tighter text-lg hover:scale-105 transition-transform shadow-xl">Masuk ke Dashboard</a>
             @else
                <a href="{{ route('login') }}" class="px-10 py-5 bg-white text-primary-600 rounded-2xl font-black uppercase tracking-tighter text-lg hover:scale-105 transition-transform shadow-xl">Mulai Sekarang</a>
                <a href="{{ route('register') }}" class="px-10 py-5 bg-primary-800 text-white rounded-2xl font-black uppercase tracking-tighter text-lg hover:bg-primary-900 transition-all border border-primary-500">Daftar Akun Baru</a>
             @endauth
        </div>
        <p class="mt-8 text-primary-200 text-xs font-bold uppercase tracking-[0.2em] text-center">Didesain untuk Standar Industri Keamanan &copy; {{ date('Y') }}</p>
    </section>
</div>
@endsection
