@extends('layouts.app')

@section('title', 'Penilaian Kandidat')

@section('content')
<div class="space-y-6 sm:space-y-8 animate-fade-in px-2 sm:px-0">
    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6">
        <div class="space-y-1">
            <h1 class="text-2xl sm:text-3xl font-black text-slate-800 uppercase tracking-tighter italic">Evaluasi & Penilaian</h1>
            <p class="text-[10px] sm:text-xs font-bold text-slate-500 uppercase tracking-[0.2em] leading-relaxed">Input nilai mentah kandidat untuk kalkulasi Weighted Product.</p>
        </div>
        
        <!-- Period Filter -->
        <form action="{{ route('penilaian.index') }}" method="GET" class="w-full sm:w-auto">
            <div class="relative group">
                <select name="periode_id" onchange="this.form.submit()" class="w-full sm:w-64 pl-6 pr-10 py-4 bg-white/70 backdrop-blur-md border-none rounded-3xl text-[10px] font-black text-slate-800 uppercase tracking-widest shadow-xl shadow-slate-200/50 appearance-none cursor-pointer focus:ring-4 focus:ring-primary-500/10 transition-all">
                    <option value="" disabled>Pilih Periode Seleksi</option>
                    @foreach($periode as $p)
                        <option value="{{ $p->id }}" {{ $activePeriodeId == $p->id ? 'selected' : '' }}>
                            {{ $p->nama_periode }} ({{ strtoupper($p->status) }})
                        </option>
                    @endforeach
                </select>
                <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400 group-hover:text-primary-500 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>
        </form>
    </div>

    @if($kandidats->count() > 0 && $kriterias->count() > 0)
        <form action="{{ route('penilaian.store') }}" method="POST" class="relative">
            @csrf
            <input type="hidden" name="periode_id" value="{{ $activePeriodeId }}">
            
            <x-card class="!p-0 border-none shadow-2xl overflow-hidden bg-white/80 backdrop-blur-md">
                <div class="overflow-x-auto custom-scrollbar">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-secondary-900 text-white uppercase tracking-[0.2em] text-[10px] font-black">
                                <th class="px-8 py-6 sticky left-0 z-30 bg-secondary-900 border-r border-white/5 min-w-[240px] shadow-[8px_0_15px_-5px_rgba(0,0,0,0.1)]">
                                    Identitas Kandidat
                                </th>
                                @foreach($kriterias as $k)
                                    <th class="px-8 py-6 text-center min-w-[160px] border-r border-white/5 last:border-none">
                                        <div class="flex flex-col items-center gap-1.5">
                                            <span>{{ $k->nama }}</span>
                                            <span class="px-2.5 py-0.5 rounded-lg bg-white/10 text-[8px] font-black text-primary-400 uppercase tracking-tighter">
                                                {{ ucfirst($k->tipe) }}
                                            </span>
                                        </div>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($kandidats as $kandidat)
                                <tr class="group hover:bg-primary-50/40 transition-all duration-300">
                                    <td class="px-8 py-6 sticky left-0 z-20 bg-white group-hover:bg-primary-50 transition-all border-r border-slate-100 shadow-[8px_0_15px_-5px_rgba(0,0,0,0.02)]">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-[10px] font-black text-slate-400 group-hover:bg-primary-600 group-hover:text-white transition-all shadow-inner">
                                                {{ substr($kandidat->nama, 0, 2) }}
                                            </div>
                                            <span class="text-xs sm:text-sm font-black text-slate-800 group-hover:text-primary-800 transition-colors uppercase tracking-tight">{{ $kandidat->nama }}</span>
                                        </div>
                                    </td>
                                    @foreach($kriterias as $kriteria)
                                        @php 
                                            $val = $penilaians->has($kandidat->id) && $penilaians[$kandidat->id]->has($kriteria->id) 
                                                ? $penilaians[$kandidat->id][$kriteria->id]->nilai 
                                                : '';
                                        @endphp
                                        <td class="px-8 py-6 text-center border-r last:border-none border-slate-100/50">
                                            <div class="relative inline-block w-full">
                                                <input type="number" 
                                                    name="nilai[{{ $kandidat->id }}][{{ $kriteria->id }}]" 
                                                    value="{{ $val }}"
                                                    min="0" max="100" step="0.01"
                                                    class="w-full max-w-[100px] text-center px-4 py-3.5 text-xs font-black text-slate-800 placeholder-slate-300 bg-white border border-slate-100 rounded-2xl focus:border-primary-500 focus:ring-8 focus:ring-primary-500/10 transition-all shadow-sm group-hover:shadow-md disabled:opacity-50 disabled:bg-slate-50"
                                                    placeholder="Input Score"
                                                    {{ $periode->firstWhere('id', $activePeriodeId)->status == 'selesai' ? 'disabled' : 'required' }}>
                                            </div>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Bottom Action & Info bar -->
                <div class="p-6 sm:p-10 bg-slate-50/50 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-8">
                    <div class="space-y-2">
                        <div class="flex items-center gap-3 text-[10px] font-black text-slate-800 uppercase tracking-widest italic animate-pulse">
                            <span class="w-2.5 h-2.5 rounded-full bg-primary-500"></span>
                            Panduan Penginputan Nilai
                        </div>
                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-[0.2em] max-w-md leading-relaxed pl-5">
                            Gunakan skala 1-100. Sistem akan melakukan normalisasi otomatis saat perhitungan Weighted Product dilakukan pada halaman ranking.
                        </p>
                    </div>

                    @if($periode->firstWhere('id', $activePeriodeId)->status != 'selesai')
                        <button type="submit" class="btn-premium bg-primary-600 text-white hover:bg-primary-700 px-12 py-5 flex items-center justify-center gap-4 shadow-xl shadow-primary-900/10 group/btn active:scale-95 w-full sm:w-auto">
                            <div class="p-1.5 bg-white/20 rounded-lg group-hover/btn:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                </svg>
                            </div>
                            <span class="text-[10px] font-black uppercase tracking-[0.2em]">Simpan Evaluasi</span>
                        </button>
                    @else
                        <div class="px-10 py-5 bg-rose-50 text-rose-700 rounded-3xl font-black uppercase text-[10px] tracking-widest flex items-center gap-4 border border-rose-100 italic shadow-sm w-full sm:w-auto justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            Status: Periode Terkunci
                        </div>
                    @endif
                </div>
            </x-card>
        </form>
    @else
        <div class="py-12 px-2">
            <x-card class="bg-indigo-50/40 border-dashed border-2 border-indigo-100 shadow-2xl flex flex-col items-center justify-center p-10 sm:p-24 text-center relative overflow-hidden group rounded-[3rem]">
                <!-- Decorative effects -->
                <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-indigo-500/5 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -left-10 -top-10 w-48 h-48 bg-primary-500/5 rounded-full blur-2xl pointer-events-none"></div>

                <div class="relative z-10 space-y-10 max-w-xl">
                    <div class="inline-flex p-10 rounded-[3rem] bg-white text-indigo-400 mb-2 border-8 border-indigo-50 shadow-2xl group-hover:scale-110 transition-transform duration-700">
                        <svg class="w-16 h-16 sm:w-20 sm:h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    </div>
                    
                    <div class="space-y-4">
                        <h3 class="text-3xl sm:text-4xl font-black text-indigo-900 uppercase tracking-tighter italic">Evaluasi Tertunda</h3>
                        <p class="text-xs sm:text-sm text-indigo-600/60 font-black uppercase tracking-widest leading-relaxed">Sistem Belum Menemukan Data Kandidat Atau Kriteria Aktif.</p>
                    </div>

                    <div class="flex flex-col sm:flex-row items-center justify-center gap-6 pt-6">
                        <a href="{{ route('kandidat.index') }}" class="btn-premium w-full sm:w-auto bg-indigo-600 text-white hover:bg-indigo-700 px-12 py-5 shadow-xl shadow-indigo-600/20 text-[10px] tracking-widest uppercase font-black">
                            Konfigurasi Data Master
                        </a>
                        <a href="{{ route('guide.quick') }}" class="btn-premium w-full sm:w-auto bg-white text-indigo-600 border border-indigo-50 hover:bg-indigo-50 px-12 py-5 text-[10px] tracking-widest uppercase font-black">
                            Bantuan Sistem
                        </a>
                    </div>
                </div>
            </x-card>
        </div>
    @endif
</div>
@endsection