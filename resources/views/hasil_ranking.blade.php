@extends('layouts.app')

@section('title', 'Hasil Ranking (Weighted Product)')

@section('content')
<div class="space-y-6 sm:space-y-10 animate-fade-in px-2 sm:px-0">
    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-8 pb-4 border-b border-slate-100/50">
        <div class="space-y-2">
            <div class="flex items-center gap-3">
                <h1 class="text-2xl sm:text-3xl font-black text-slate-800 uppercase tracking-tighter italic">Ranking: {{ $activePeriode->nama_periode ?? 'Semua' }}</h1>
                <div x-data="{ open: false }" class="relative inline-block">
                    <button @mouseover="open = true" @mouseleave="open = false" class="text-slate-300 hover:text-primary-600 transition-colors mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button>
                    <div x-show="open" x-cloak class="absolute z-40 w-72 p-5 mt-3 text-[10px] font-bold text-white bg-secondary-950 rounded-[2rem] shadow-2xl -left-10 animate-fade-in border border-white/5 backdrop-blur-xl">
                        <p class="font-black border-b border-white/10 pb-3 mb-3 uppercase tracking-widest text-primary-400 italic">Metode Weighted Product (WP)</p>
                        <ul class="space-y-3 opacity-90 leading-relaxed uppercase tracking-widest text-[9px]">
                            <li class="flex gap-2">
                                <span class="text-primary-500">•</span>
                                <div><b class="text-white">Vektor S:</b> Hasil perkalian nilai kriteria berpangkat bobot.</div>
                            </li>
                            <li class="flex gap-2">
                                <span class="text-primary-500">•</span>
                                <div><b class="text-white">Vektor V:</b> Nilai Preferensi Akhir (Probabilitas).</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-widest {{ ($activePeriode->status ?? '') == 'selesai' ? 'bg-rose-50 text-rose-600 border border-rose-100' : 'bg-emerald-50 text-emerald-600 border border-emerald-100' }}">
                    Status: {{ $activePeriode->status ?? 'Draft' }}
                </span>
                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-[0.2em] italic">Objektivitas Berbasis WP</span>
            </div>
        </div>
        
        <div class="flex flex-col sm:flex-row items-center gap-4 w-full sm:w-auto">
            <!-- Period Filter -->
            <form action="{{ route('hasil-ranking.index') }}" method="GET" class="w-full sm:w-auto">
                <div class="relative group">
                    <select name="periode_id" onchange="this.form.submit()" class="w-full sm:w-64 pl-6 pr-10 py-4 bg-white/70 backdrop-blur-md border-none rounded-3xl text-[10px] font-black text-slate-800 uppercase tracking-widest shadow-xl shadow-slate-200/50 appearance-none cursor-pointer focus:ring-4 focus:ring-primary-500/10 transition-all">
                        <option value="" disabled>Ganti Periode</option>
                        @foreach($periode as $p)
                            <option value="{{ $p->id }}" {{ $activePeriodeId == $p->id ? 'selected' : '' }}>
                                {{ $p->nama_periode }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </form>

            @if(count($hasil) > 0)
            <a href="{{ route('hasil-ranking.export-pdf', ['periode_id' => $activePeriodeId]) }}" class="btn-premium bg-rose-600 text-white hover:bg-rose-700 flex items-center justify-center gap-4 px-10 py-4 w-full sm:w-auto shadow-xl shadow-rose-900/10 active:scale-95 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                <span class="text-[10px] font-black uppercase tracking-[0.2em]">Export PDF</span>
            </a>
            @endif
        </div>
    </div>

    @if(count($hasil) > 0)
        <!-- Top 3 Podium (Responsive Grid) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-6 items-end py-10 md:pt-14">
            <!-- Rank 2 -->
            @if(isset($hasil[1]))
            <div class="order-2 md:order-1 px-4 md:px-0">
                <x-card class="relative bg-white/80 border-none shadow-2xl overflow-hidden hover:scale-[1.03] transition-all duration-500 rounded-[2.5rem]">
                    <div class="absolute top-0 right-0 p-6 opacity-[0.03]">
                        <span class="text-8xl font-black text-slate-900">2</span>
                    </div>
                    <div class="flex flex-col items-center text-center space-y-6">
                        <div class="w-24 h-24 rounded-[2rem] bg-slate-50 border-4 border-white shadow-xl flex items-center justify-center text-2xl font-black text-slate-300 group-hover:rotate-6 transition-transform">
                            {{ substr($hasil[1]->kandidat->nama, 0, 2) }}
                        </div>
                        <div class="space-y-1">
                            <span class="px-4 py-1.5 bg-slate-100 rounded-full text-[9px] font-black text-slate-500 uppercase tracking-[0.2em] italic">Runner Up</span>
                            <h3 class="text-lg font-black text-slate-800 uppercase leading-none pt-2">{{ $hasil[1]->kandidat->nama }}</h3>
                            <p class="text-3xl font-black text-primary-600 pt-1">{{ number_format($hasil[1]->nilai_v, 4) }}</p>
                        </div>
                    </div>
                </x-card>
            </div>
            @endif

            <!-- Rank 1 (Featured) -->
            @if(isset($hasil[0]))
            <div class="order-1 md:order-2 md:scale-110 px-2 md:px-0">
                <x-card class="relative bg-secondary-950 border-none shadow-[0_40px_70px_-20px_rgba(79,70,229,0.4)] overflow-hidden rounded-[3rem]">
                    <!-- Glow effect -->
                    <div class="absolute -top-32 -right-32 w-64 h-64 bg-primary-500/20 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-16 -left-16 w-32 h-32 bg-indigo-500/10 rounded-full blur-2xl"></div>
                    
                    <div class="relative z-10 flex flex-col items-center text-center space-y-8 py-8 px-4">
                        <div class="w-28 h-28 rounded-[2.5rem] bg-primary-600 border-4 border-primary-400 shadow-[0_0_30px_rgba(79,70,229,0.6)] flex items-center justify-center text-3xl font-black text-white transform hover:rotate-12 transition-transform duration-500">
                            {{ substr($hasil[0]->kandidat->nama, 0, 2) }}
                        </div>
                        <div class="space-y-4">
                            <div class="inline-flex items-center gap-2 px-6 py-2 bg-primary-500 text-white rounded-full text-[10px] font-black uppercase tracking-[0.3em] shadow-xl animate-bounce">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                                Pemenang Utama
                            </div>
                            <h3 class="text-2xl font-black text-white uppercase italic tracking-tighter">{{ $hasil[0]->kandidat->nama }}</h3>
                            <div class="pt-2 border-t border-white/10">
                                <p class="text-[9px] text-primary-400 font-bold uppercase tracking-[0.3em] mb-1">Skor Akhir (Preferensi V)</p>
                                <p class="text-5xl font-black text-white italic tracking-tighter">{{ number_format($hasil[0]->nilai_v, 4) }}</p>
                            </div>
                        </div>
                    </div>
                </x-card>
            </div>
            @endif

            <!-- Rank 3 -->
            @if(isset($hasil[2]))
            <div class="order-3 px-4 md:px-0">
                <x-card class="relative bg-white/80 border-none shadow-2xl overflow-hidden hover:scale-[1.03] transition-all duration-500 rounded-[2.5rem]">
                    <div class="absolute top-0 right-0 p-6 opacity-[0.03]">
                        <span class="text-8xl font-black text-slate-900">3</span>
                    </div>
                    <div class="flex flex-col items-center text-center space-y-6">
                        <div class="w-24 h-24 rounded-[2rem] bg-amber-50 border-4 border-white shadow-xl flex items-center justify-center text-2xl font-black text-amber-200 group-hover:-rotate-6 transition-transform">
                            {{ substr($hasil[2]->kandidat->nama, 0, 2) }}
                        </div>
                        <div class="space-y-1">
                            <span class="px-4 py-1.5 bg-amber-50 rounded-full text-[9px] font-black text-amber-600 uppercase tracking-[0.2em] italic">Peringkat 3</span>
                            <h3 class="text-lg font-black text-slate-800 uppercase leading-none pt-2">{{ $hasil[2]->kandidat->nama }}</h3>
                            <p class="text-3xl font-black text-primary-600 pt-1">{{ number_format($hasil[2]->nilai_v, 4) }}</p>
                        </div>
                    </div>
                </x-card>
            </div>
            @endif
        </div>

        <!-- Full Table List -->
        <div class="pt-10">
            <x-card class="!p-0 border-none shadow-[0_30px_60px_-12px_rgba(0,0,0,0.12)] overflow-hidden bg-white/80 backdrop-blur-md rounded-[2.5rem]">
                <div class="overflow-x-auto custom-scrollbar">
                    <x-table class="w-full">
                        <x-slot name="thead">
                            <tr class="bg-slate-50 border-b border-slate-100 uppercase tracking-[0.2em] text-[10px] font-black text-slate-400">
                                <th class="px-10 py-7 text-center w-28">Peringkat</th>
                                <th class="px-8 py-7 text-left min-w-[280px]">Identitas Kandidat</th>
                                <th class="px-8 py-7 text-center">Vektor S (Produk)</th>
                                <th class="px-10 py-7 text-right whitespace-nowrap">Nilai V (Preferensi)</th>
                            </tr>
                        </x-slot>

                        @foreach($hasil as $index => $row)
                            <tr class="group hover:bg-primary-50/40 transition-all duration-300">
                                <td class="px-10 py-6 text-center">
                                    <span class="text-sm font-black text-slate-300 group-hover:text-primary-600 transition-colors uppercase italic italic-black tracking-widest">#{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-5">
                                        <div class="w-11 h-11 rounded-2xl bg-white border border-slate-100 flex items-center justify-center text-[10px] font-black text-slate-400 group-hover:bg-primary-600 group-hover:text-white transition-all shadow-sm">
                                            {{ substr($row->kandidat->nama, 0, 2) }}
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-sm font-black text-slate-700 uppercase tracking-tight group-hover:text-slate-900 transition-colors">{{ $row->kandidat->nama }}</span>
                                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1">ID: KND-{{ str_pad($row->kandidat_id, 4, '0', STR_PAD_LEFT) }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="text-[11px] font-black text-slate-400 font-mono tracking-tighter">{{ number_format($row->nilai_s, 6) }}</span>
                                </td>
                                <td class="px-10 py-6 text-right">
                                    <span class="inline-flex items-center px-5 py-3 rounded-2xl bg-slate-50 border border-slate-100 text-slate-700 font-mono text-sm font-black shadow-inner group-hover:bg-primary-600 group-hover:text-white group-hover:border-primary-500 transition-all">
                                        {{ number_format($row->nilai_v, 4) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </x-table>
                </div>
            </x-card>
        </div>
    @else
        <div class="py-12 px-2">
            <x-card class="bg-rose-50/40 border-dashed border-2 border-rose-100 shadow-2xl flex flex-col items-center justify-center p-10 sm:p-24 text-center relative overflow-hidden group rounded-[3rem]">
                <!-- Decorative shapes -->
                <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-rose-500/5 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -left-10 -top-10 w-48 h-48 bg-amber-500/5 rounded-full blur-2xl pointer-events-none"></div>

                <div class="relative z-10 space-y-10 max-w-xl">
                    <div class="inline-flex p-10 rounded-[3rem] bg-white text-rose-400 mb-2 border-8 border-rose-50 shadow-2xl group-hover:rotate-12 transition-transform duration-700">
                        <svg class="w-16 h-16 sm:w-20 sm:h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                    
                    <div class="space-y-4">
                        <h3 class="text-3xl sm:text-4xl font-black text-rose-900 uppercase tracking-tighter italic">Kalkulasi Tertunda</h3>
                        <p class="text-[10px] sm:text-xs text-rose-600/60 font-black uppercase tracking-widest leading-relaxed">Ranking belum tersedia karena proses penilaian kandidat belum selesai atau belum ada data yang masuk.</p>
                    </div>

                    <div class="flex flex-col sm:flex-row items-center justify-center gap-6 pt-6">
                        <a href="{{ route('penilaian.index') }}" class="btn-premium w-full sm:w-auto bg-rose-600 text-white hover:bg-rose-700 px-12 py-5 shadow-xl shadow-rose-600/20 text-[10px] tracking-widest uppercase font-black">
                            Input Penilaian Sekarang
                        </a>
                        <a href="{{ route('guide.quick') }}" class="btn-premium w-full sm:w-auto bg-white text-rose-600 border border-rose-50 hover:bg-rose-50 px-12 py-5 text-[10px] tracking-widest uppercase font-black">
                            Lihat Jalur Berkas
                        </a>
                    </div>
                </div>
            </x-card>
        </div>
    @endif
</div>
@endsection
