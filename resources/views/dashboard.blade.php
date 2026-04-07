@extends('layouts.app')

@section('title', 'Ringkasan Dashboard')

@section('content')
@php
    $hour = date('H');
    $greeting = $hour < 12 ? 'Pagi' : ($hour < 15 ? 'Siang' : ($hour < 18 ? 'Sore' : 'Malam'));
@endphp

<div class="space-y-10 sm:space-y-12 animate-fade-in-up px-2 sm:px-0 pb-12">
    <!-- Premium Hero Section -->
    <div class="relative group h-full">
        <div class="absolute -inset-1 bg-gradient-to-r from-primary-600 to-indigo-600 rounded-[3rem] blur opacity-25 group-hover:opacity-40 transition duration-1000 group-hover:duration-200"></div>
        <div class="relative overflow-hidden p-8 sm:p-14 rounded-[2.8rem] bg-secondary-950 text-white shadow-3xl flex flex-col lg:flex-row items-center justify-between gap-10">
            <div class="relative z-10 space-y-6 text-center lg:text-left max-w-2xl">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-primary-500 animate-pulse"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-primary-400">System Online</span>
                </div>
                <h1 class="text-4xl sm:text-6xl font-black tracking-tighter leading-[0.9] uppercase italic italic-black">
                    Selamat {{ $greeting }}, <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-indigo-400">{{ Auth::user()->name }}</span>
                </h1>
                <p class="text-secondary-400 text-xs sm:text-base font-medium leading-relaxed uppercase tracking-widest opacity-80">
                    Otomatisasi Seleksi Personel Keamanan dengan Akurasi <span class="text-white">Multi-Kriteria</span> & <span class="text-white">Objektivitas</span> Data.
                </p>
                <div class="flex flex-wrap justify-center lg:justify-start gap-4 pt-4">
                    <a href="{{ route('periode.create') }}" class="px-8 py-4 bg-primary-600 text-white rounded-2xl font-black uppercase tracking-widest text-[10px] shadow-2xl shadow-primary-500/20 hover:bg-primary-500 transition-all active:scale-95">
                        Inisialisasi Seleksi
                    </a>
                    <a href="{{ route('hasil-ranking.index') }}" class="px-8 py-4 bg-white/5 text-white border border-white/10 rounded-2xl font-black uppercase tracking-widest text-[10px] hover:bg-white/10 transition-all">
                        Tinjau Hasil Akhir
                    </a>
                </div>
            </div>

            <!-- Floating Illustration Area -->
            <div class="relative w-full max-w-[320px] lg:max-w-md aspect-square flex items-center justify-center">
                <div class="absolute inset-0 bg-primary-500/20 rounded-full blur-[100px] animate-pulse"></div>
                <!-- Glass Abstract Elements -->
                <div class="relative grid grid-cols-2 gap-4 p-6 w-full">
                    <div class="aspect-square rounded-3xl bg-white/5 backdrop-blur-xl border border-white/10 flex flex-col items-center justify-center space-y-2 transform -rotate-6 hover:rotate-0 transition-transform duration-500 shadow-2xl">
                        <span class="text-4xl font-black text-primary-500">{{ $jumlahKandidat ?? 0 }}</span>
                        <span class="text-[8px] font-black uppercase tracking-widest text-slate-400">Total Personel</span>
                    </div>
                    <div class="aspect-square rounded-3xl bg-secondary-900/50 backdrop-blur-xl border border-white/5 flex flex-col items-center justify-center space-y-2 transform translate-y-8 rotate-12 hover:rotate-0 transition-transform duration-500 shadow-2xl">
                        <span class="text-4xl font-black text-indigo-400">{{ $jumlahKriteria ?? 0 }}</span>
                        <span class="text-[8px] font-black uppercase tracking-widest text-slate-400">Metrik Seleksi</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Decorative Background Mesh -->
        <div class="absolute -right-20 -top-20 w-80 h-80 bg-primary-600/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-indigo-600/10 rounded-full blur-[120px] pointer-events-none"></div>
    </div>

    <!-- Enhanced Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
        <!-- Stat: Personel -->
        <div class="group relative">
            <div class="absolute inset-0 bg-primary-100 rounded-[2.5rem] transform rotate-3 group-hover:rotate-0 transition-transform duration-500"></div>
            <x-card class="relative flex flex-col gap-6 p-8 bg-white border-none shadow-2xl rounded-[2.5rem]">
                <div class="flex justify-between items-start">
                    <div class="p-5 bg-primary-50 text-primary-600 rounded-3xl group-hover:scale-110 transition-transform duration-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Kandidat</p>
                        <h4 class="text-3xl font-black text-slate-900 tracking-tighter">{{ $jumlahKandidat ?? 0 }}</h4>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-slate-50 flex items-center justify-between">
                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Total Terdaftar</span>
                    <a href="{{ route('kandidat.index') }}" class="text-[10px] font-black text-primary-600 uppercase hover:translate-x-1 transition-transform tracking-widest">Lihat Semua →</a>
                </div>
            </x-card>
        </div>

        <!-- Stat: Parameter -->
        <div class="group relative">
            <div class="absolute inset-0 bg-indigo-100 rounded-[2.5rem] transform -rotate-3 group-hover:rotate-0 transition-transform duration-500"></div>
            <x-card class="relative flex flex-col gap-6 p-8 bg-white border-none shadow-2xl rounded-[2.5rem]">
                <div class="flex justify-between items-start">
                    <div class="p-5 bg-indigo-50 text-indigo-600 rounded-3xl group-hover:scale-110 transition-transform duration-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Parameter</p>
                        <h4 class="text-3xl font-black text-slate-900 tracking-tighter">{{ $jumlahKriteria ?? 0 }}</h4>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-slate-50 flex items-center justify-between">
                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Kriteria Aktif</span>
                    <a href="{{ route('kriteria.index') }}" class="text-[10px] font-black text-indigo-600 uppercase hover:translate-x-1 transition-transform tracking-widest">Kelola Bobot →</a>
                </div>
            </x-card>
        </div>

        <!-- Stat: Status Selection -->
        <div class="group relative md:col-span-2 lg:col-span-1">
            @php $isActive = isset($periodeAktif) && $periodeAktif && $periodeAktif->status == 'aktif'; @endphp
            <div class="absolute inset-0 {{ $isActive ? 'bg-emerald-100' : 'bg-amber-100' }} rounded-[2.5rem] transform rotate-1 group-hover:rotate-0 transition-transform duration-500"></div>
            <x-card class="relative flex flex-col gap-6 p-8 bg-white border-none shadow-2xl rounded-[2.5rem]">
                <div class="flex justify-between items-start">
                    <div class="p-5 {{ $isActive ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-600' }} rounded-3xl group-hover:scale-110 transition-transform duration-500 relative">
                        @if($isActive)
                            <div class="absolute -top-1 -right-1 w-4 h-4 bg-emerald-500 rounded-full border-4 border-white animate-ping"></div>
                        @endif
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Status Periode</p>
                        <h4 class="text-xl font-black {{ $isActive ? 'text-emerald-700' : 'text-amber-700' }} tracking-tight uppercase truncate max-w-[150px]">
                            {{ $isActive ? $periodeAktif->nama_periode : 'Inaktif' }}
                        </h4>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-slate-50 flex items-center justify-between">
                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Status Inisiasi</span>
                    @if($isActive)
                       <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest italic tracking-wider">Sedang Berjalan</span>
                    @else
                       <a href="{{ route('periode.index') }}" class="text-[10px] font-black text-amber-600 uppercase hover:translate-x-1 transition-transform tracking-widest">Aktifkan →</a>
                    @endif
                </div>
            </x-card>
        </div>
    </div>

    <!-- Secondary Info Sections -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Mission Control / Active Period Details -->
        <div class="lg:col-span-7 space-y-6">
            <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.4em] px-4 flex items-center gap-4">
                Mission Control Area
                <div class="h-px flex-1 bg-slate-100"></div>
            </h3>
            
            @if(isset($periodeAktif) && $periodeAktif)
               <x-card class="bg-white border-none shadow-2xl rounded-[3rem] p-10 overflow-hidden relative group">
                    <div class="absolute top-0 right-0 p-8">
                        <div class="w-24 h-24 bg-primary-50 rounded-full flex items-center justify-center -mr-12 -mt-12 group-hover:scale-150 transition-transform duration-700 opacity-20">
                             <svg class="w-12 h-12 text-primary-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                        </div>
                    </div>

                    <div class="relative z-10 flex flex-col sm:flex-row gap-10 items-center">
                        <div class="w-full sm:w-1/3 flex flex-col items-center sm:items-start text-center sm:text-left space-y-2">
                             <span class="text-[10px] font-black text-primary-400 uppercase tracking-[0.3em]">Aktif Saat Ini</span>
                             <h4 class="text-2xl font-black text-slate-800 uppercase tracking-tighter italic italic-black leading-none">{{ $periodeAktif->nama_periode }}</h4>
                             <div class="mt-4 px-4 py-2 rounded-full bg-primary-600 text-white text-[9px] font-black uppercase tracking-widest inline-block">Seleksi Prioritas</div>
                        </div>
                        
                        <div class="flex-1 w-full grid grid-cols-2 gap-6 p-8 bg-slate-50 rounded-[2.5rem] border border-slate-100 shadow-inner">
                            <div class="space-y-1">
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Dimulai Pada</p>
                                <p class="text-sm font-black text-slate-700 italic underline decoration-primary-500/30">{{ \Carbon\Carbon::parse($periodeAktif->tanggal_mulai)->format('d M Y') }}</p>
                            </div>
                            <div class="space-y-1 text-right">
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Berakhir Pada</p>
                                <p class="text-sm font-black text-slate-700 italic underline decoration-rose-500/30">{{ \Carbon\Carbon::parse($periodeAktif->tanggal_selesai)->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-10 flex items-center justify-between pt-6 border-t border-slate-50">
                         <div class="flex -space-x-4">
                             @for($i=0; $i<5; $i++)
                                <div class="w-10 h-10 rounded-full border-4 border-white bg-slate-200 flex items-center justify-center text-[10px] font-black text-slate-400">?</div>
                             @endfor
                         </div>
                         <a href="{{ route('periode.show', $periodeAktif->id) }}" class="btn-premium bg-slate-900 text-white hover:bg-black py-4 px-10 shadow-black/10">
                            <span class="text-[10px] font-black uppercase tracking-widest">Dashboard Periode →</span>
                         </a>
                    </div>
               </x-card>
            @else
               <x-card class="bg-white border-2 border-dashed border-slate-100 shadow-none rounded-[3rem] p-12 text-center flex flex-col items-center justify-center space-y-6">
                    <div class="w-20 h-20 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </div>
                    <div class="space-y-1">
                        <h4 class="text-lg font-black text-slate-800 uppercase tracking-tight">Kesiapan Sistem: Menunggu</h4>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest max-w-[300px] leading-relaxed mx-auto">Belum ada periode aktif yang terdeteksi. Silakan aktifkan periode untuk memulai proses kalkulasi AHP & WP.</p>
                    </div>
                    <a href="{{ route('periode.create') }}" class="btn-premium bg-primary-600 text-white hover:bg-primary-700 px-10 py-5">
                        <span class="text-[10px] font-black uppercase tracking-[0.2em]">Inisialisasi Sekarang</span>
                    </a>
               </x-card>
            @endif
        </div>

        <!-- Methodology Insights -->
        <div class="lg:col-span-5 space-y-6 h-full">
            <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.4em] px-4 flex items-center gap-4 text-right">
                <div class="h-px flex-1 bg-slate-100"></div>
                Technology Stack
            </h3>

            <div class="relative bg-secondary-950 rounded-[3rem] p-10 overflow-hidden shadow-3xl text-white flex flex-col h-full min-h-[400px]">
                <div class="absolute -top-20 -left-20 w-64 h-64 bg-primary-500/10 rounded-full blur-[80px]"></div>
                
                <div class="relative z-10 flex flex-col h-full justify-between gap-10">
                    <div class="space-y-4">
                        <h4 class="text-3xl font-black italic italic-black tracking-tighter uppercase leading-[0.8] mb-6">Metodologi Komputasi</h4>
                        <div class="space-y-6">
                            <div class="flex gap-4">
                                <div class="w-1 h-12 bg-primary-500 rounded-full shrink-0"></div>
                                <div>
                                    <h5 class="text-[10px] font-black text-primary-400 uppercase tracking-widest mb-1">Analytical Hierarchy Process</h5>
                                    <p class="text-xs text-white/50 leading-relaxed font-medium uppercase tracking-tight">Digunakan untuk menentukan bobot prioritas setiap kriteria secara perbandingan berpasangan.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="w-1 h-12 bg-indigo-500 rounded-full shrink-0"></div>
                                <div>
                                    <h5 class="text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-1">Weighted Product (WP)</h5>
                                    <p class="text-xs text-white/50 leading-relaxed font-medium uppercase tracking-tight">Algoritma perankingan yang menonjolkan bobot kepentingan dengan perkalian pangkat atribut.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-6 rounded-3xl bg-white/5 border border-white/10 text-center">
                            <p class="text-2xl font-black text-white italic">Objektif</p>
                            <p class="text-[8px] font-black text-white/30 uppercase tracking-[0.2em] mt-2">Zero Bias</p>
                        </div>
                        <div class="p-6 rounded-3xl bg-white/5 border border-white/10 text-center">
                             <p class="text-2xl font-black text-white italic">Presisi</p>
                             <p class="text-[8px] font-black text-white/30 uppercase tracking-[0.2em] mt-2">Data-Driven</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection