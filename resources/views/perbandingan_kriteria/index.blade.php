@extends('layouts.app')

@section('title', 'Perbandingan Kriteria (AHP)')

@section('content')
<div class="space-y-8 animate-fade-in">
    <!-- Header Page -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-3">
                <h1 class="text-2xl font-bold text-slate-800 uppercase tracking-tight">Hirarki Prioritas AHP</h1>
                <div x-data="{ open: false }" class="relative inline-block">
                    <button @mouseover="open = true" @mouseleave="open = false" class="text-slate-400 hover:text-primary-600 transition-colors mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button>
                    <div x-show="open" x-cloak class="absolute z-30 w-72 p-4 mt-2 text-xs font-medium text-white bg-slate-800 rounded-2xl shadow-2xl -left-10 animate-fade-in">
                        <p class="font-bold border-b border-white/20 pb-2 mb-2 uppercase tracking-tighter text-primary-400">Skala Saaty (1-9):</p>
                        <ul class="space-y-2 opacity-90">
                            <li>• <b>1:</b> Sama Penting.</li>
                            <li>• <b>3:</b> Sedikit Lebih Penting.</li>
                            <li>• <b>5:</b> Lebih Penting.</li>
                            <li>• <b>7:</b> Sangat Lebih Penting.</li>
                            <li>• <b>9:</b> Mutlak Lebih Penting.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <p class="text-sm text-slate-500">Tentukan preferensi kepentingan antar kriteria menggunakan skala Saaty (1-9).</p>
        </div>
        @if($bobot->count() > 0)
            <div class="px-4 py-2 bg-emerald-50 text-emerald-700 rounded-xl border border-emerald-100 flex items-center gap-2 shadow-sm">
                <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                <span class="text-xs font-bold uppercase tracking-widest leading-none">Matriks Konsisten</span>
            </div>
        @endif
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        <!-- Input Section -->
        <div class="lg:col-span-2 space-y-6">
            @if($kriteria->count() < 2)
                <x-card class="bg-white/70 backdrop-blur-sm border-none shadow-xl border-dashed border-2 border-slate-200">
                    <div class="py-20 flex flex-col items-center text-center space-y-6">
                        <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center text-slate-300 shadow-inner">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        </div>
                        <div class="max-w-md space-y-2">
                            <h3 class="text-xl font-black text-slate-800 uppercase tracking-tight">Kriteria Tidak Mencukupi</h3>
                            <p class="text-[10px] text-slate-500 font-bold uppercase tracking-[0.2em] leading-loose">Anda membutuhkan minimal <span class="text-primary-600 font-black">2 kriteria</span> untuk melakukan perbandingan berpasangan AHP.</p>
                        </div>
                        <a href="{{ route('kriteria.index') }}" class="btn-premium bg-primary-600 text-white hover:bg-primary-700 px-8 py-3 show-lg shadow-primary-600/20">
                            Kelola Kriteria Sekarang
                        </a>
                    </div>
                </x-card>
            @else
                <x-card class="bg-white/70 backdrop-blur-sm border-none shadow-xl">
                    <x-slot name="header">
                        <h3 class="font-black text-slate-800 uppercase tracking-tighter">Matriks Perbandingan Berpasangan</h3>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">Lakukan perbandingan untuk setiap pasang kriteria</p>
                    </x-slot>

                    <form action="{{ route('perbandingan-kriteria.store') }}" method="POST" class="space-y-12">
                        @csrf
                        
                        @php 
                            $ids = $kriteria->pluck('id')->toArray();
                            $pairs = [];
                            for($i=0; $i < count($ids); $i++) {
                                for($j=$i+1; $j < count($ids); $j++) {
                                    $pairs[] = [$ids[$i], $ids[$j]];
                                }
                            }
                        @endphp

                        <div class="divide-y divide-slate-100">
                            @foreach($pairs as $pair)
                                @php 
                                    $k1 = $kriteria->find($pair[0]);
                                    $k2 = $kriteria->find($pair[1]);
                                    $key = $k1->id . '-' . $k2->id;
                                    $val = $comparisons->has($key) ? $comparisons[$key]->nilai : 1;
                                @endphp
                                
                                <div class="py-10 first:pt-0 last:pb-0">
                                    <div class="grid grid-cols-1 md:grid-cols-11 items-center gap-4">
                                        <!-- Kriteria 1 -->
                                        <div class="md:col-span-3 text-center md:text-right">
                                            <div class="p-3 rounded-2xl bg-primary-50 border border-primary-100 shadow-sm transition-all">
                                                <span class="text-xs font-black text-primary-700 uppercase tracking-tight block truncate">{{ $k1->nama }}</span>
                                            </div>
                                        </div>

                                        <!-- Comparison Logic / Slider -->
                                        <div class="md:col-span-5 space-y-4">
                                            <div class="relative pt-1 flex flex-col items-center">
                                                <input type="range" name="nilai[{{ $key }}]" 
                                                    min="-9" max="9" step="1" value="{{ $val }}"
                                                    class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-primary-600 slider-ahp"
                                                    oninput="updateValDisplay(this, 'display-{{ $key }}', '{{ $k1->nama }}', '{{ $k2->nama }}')">
                                                
                                                <div id="display-{{ $key }}" class="mt-4 text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em] text-center px-4 py-1 rounded-full bg-slate-50 border border-slate-100 shadow-inner">
                                                    Tarik slider untuk menentukan kepentingan
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Kriteria 2 -->
                                        <div class="md:col-span-3 text-center md:text-left">
                                            <div class="p-3 rounded-2xl bg-indigo-50 border border-indigo-100 shadow-sm transition-all">
                                                <span class="text-xs font-black text-indigo-700 uppercase tracking-tight block truncate">{{ $k2->nama }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="pt-6 border-t border-slate-100 flex justify-end">
                            <button type="submit" class="btn-premium bg-primary-600 text-white hover:bg-primary-700 px-10 py-4 flex items-center gap-3 shadow-2xl">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                                Kalkulasi Bobot & Konsistensi
                            </button>
                        </div>
                    </form>
                </x-card>
            @endif
        </div>

        <!-- Right Side: Results & Help -->
        <div class="space-y-6">
            <!-- Results Section -->
            @if($bobot->count() > 0)
                <x-card class="bg-gradient-to-br from-white to-primary-50/30 border-none shadow-xl">
                    <x-slot name="header">
                        <div class="flex items-center gap-3">
                            <div class="p-2 rounded-lg bg-emerald-500 text-white shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </div>
                            <h3 class="font-black text-slate-800 uppercase tracking-tighter">Hasil Bobot (W)</h3>
                        </div>
                    </x-slot>

                    <div class="space-y-3">
                        @foreach($bobot as $b)
                            <div class="flex items-center justify-between p-4 rounded-2xl bg-white/70 border border-white shadow-sm group hover:scale-[1.02] transition-all duration-300">
                                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">{{ $b->kriteria->nama }}</span>
                                <div class="flex items-center gap-3">
                                    <div class="h-1.5 w-24 bg-slate-100 rounded-full overflow-hidden">
                                        <div class="h-full bg-emerald-500 rounded-full" style="width: {{ $b->bobot * 100 }}%"></div>
                                    </div>
                                    <span class="text-sm font-black text-primary-600">{{ number_format($b->bobot, 4) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-card>
            @endif

            <!-- Help Section -->
            <x-card class="bg-secondary-900 text-white overflow-hidden relative">
                <div class="relative z-10 space-y-4">
                    <h3 class="font-black uppercase tracking-tighter text-xl">Skala Saaty AHP</h3>
                    <ul class="text-[10px] space-y-2 opacity-80 font-medium">
                        <li class="flex items-start gap-2">
                            <span class="text-primary-400 font-black">1 :</span> Sama Penting (Equal)
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-primary-400 font-black">3 :</span> Cukup Lebih Penting (Moderate)
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-primary-400 font-black">5 :</span> Lebih Penting (Strong)
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-primary-400 font-black">7 :</span> Sangat Lebih Penting (Very Strong)
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-primary-400 font-black">9 :</span> Mutlak Lebih Penting (Extreme)
                        </li>
                    </ul>
                    <div class="pt-4 border-t border-white/10">
                        <p class="text-[10px] italic opacity-60">Rasio Konsistensi (CR) harus ≤ 0.1 agar hasil pembobotan dianggap valid dan logis.</p>
                    </div>
                </div>
                <!-- Decorative Icon -->
                <svg class="absolute -right-4 -bottom-4 w-24 h-24 text-white/5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                </svg>
            </x-card>
        </div>
    </div>
</div>

<script>
    function updateValDisplay(slider, targetId, k1, k2) {
        const val = parseInt(slider.value);
        const target = document.getElementById(targetId);
        const displayVal = Math.abs(val) === 0 ? 1 : Math.abs(val);
        
        if (val === 1 || val === -1) {
            target.innerHTML = `<span class="text-primary-600 font-black">1</span> : <span class="text-slate-700">${k1}</span> & <span class="text-slate-700">${k2}</span> Sama Penting`;
        } else if (val > 1) {
            target.innerHTML = `<span class="text-primary-600 font-black">${displayVal}</span> : <span class="text-slate-700">${k1}</span> Lebih Penting dari <span class="text-slate-400">${k2}</span>`;
        } else if (val < -1) {
            target.innerHTML = `<span class="text-primary-600 font-black">${displayVal}</span> : <span class="text-slate-700">${k2}</span> Lebih Penting dari <span class="text-slate-400">${k1}</span>`;
        } else {
            // value 0 is mapped to 1 effectively in logic but UI can be smoother
            slider.value = 1; 
            target.innerHTML = `<span class="text-primary-600 font-black">1</span> : Sama Penting`;
        }
    }

    // Initialize displays
    window.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.slider-ahp').forEach(slider => {
            const pair = slider.name.match(/\[(.*?)\]/)[1];
            // Since we don't easily have K1 and K2 names in JS, we just trigger the input or set a generic text
            // In a better version we'd pass k1/k2 via data attributes
        });
    });
</script>

<style>
    .slider-ahp::-webkit-slider-thumb {
        width: 24px;
        height: 24px;
        background: #4f46e5;
        border: 4px solid white;
        border-radius: 50%;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        transition: all 0.2s;
    }
    .slider-ahp::-webkit-slider-thumb:hover {
        transform: scale(1.2);
        background: #4338ca;
    }
</style>
@endsection