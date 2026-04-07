@extends('layouts.app')

@section('title', 'Manajemen Kriteria')

@section('content')
<div class="space-y-6 sm:space-y-8 animate-fade-in px-2 sm:px-0">
    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6">
        <div class="space-y-1">
            <h1 class="text-2xl sm:text-3xl font-black text-slate-800 uppercase tracking-tighter italic">Daftar Kriteria</h1>
            <p class="text-[10px] sm:text-xs font-bold text-slate-500 uppercase tracking-[0.2em] leading-relaxed">Tentukan kriteria penilaian untuk proses seleksi petugas keamanan.</p>
        </div>
        <a href="{{ route('kriteria.create') }}" class="btn-premium bg-primary-600 text-white hover:bg-primary-700 flex items-center justify-center gap-3 px-8 py-4 w-full sm:w-auto shadow-xl shadow-primary-900/10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
            </svg>
            <span class="text-[10px] font-black uppercase tracking-[0.2em]">Tambah Kriteria</span>
        </a>
    </div>

    <x-card class="!p-0 border-none shadow-2xl overflow-hidden bg-white/80 backdrop-blur-md">
        <div class="overflow-x-auto custom-scrollbar">
            <x-table class="w-full">
                <x-slot name="thead">
                    <tr class="bg-slate-50/50 border-b border-slate-100 uppercase tracking-[0.2em] text-[10px] font-black text-slate-400">
                        <th class="px-6 py-5 text-center w-16">#</th>
                        <th class="px-6 py-5 text-left">Nama Kriteria</th>
                        <th class="px-6 py-5 text-left">
                            <div class="flex items-center gap-2">
                                Tipe & Sifat
                                <div x-data="{ open: false }" class="relative inline-block">
                                    <button @mouseover="open = true" @mouseleave="open = false" class="text-slate-400 hover:text-primary-600 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                    <div x-show="open" x-cloak class="absolute z-30 w-64 p-4 mt-2 text-xs font-bold text-white bg-secondary-900 rounded-2xl shadow-2xl -left-10 animate-fade-in border border-secondary-800">
                                        <p class="font-black border-b border-white/10 pb-2 mb-2 uppercase tracking-widest text-primary-400">Panduan Tipe:</p>
                                        <ul class="space-y-2 opacity-90">
                                            <li class="flex items-start gap-2 text-[10px] tracking-wide leading-relaxed uppercase">
                                                <span class="text-emerald-400 font-black">BENEFIT:</span> Nilai makin besar makin diunggulkan.
                                            </li>
                                            <li class="flex items-start gap-2 text-[10px] tracking-wide leading-relaxed uppercase border-t border-white/5 pt-2">
                                                <span class="text-rose-400 font-black">COST:</span> Nilai makin kecil makin diunggulkan.
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </th>
                        <th class="px-8 py-5 text-right whitespace-nowrap">Manajemen Data</th>
                    </tr>
                </x-slot>

                @forelse($kriteria as $i => $k)
                    <tr class="group hover:bg-primary-50/30 transition-all duration-300">
                        <td class="px-6 py-5 text-center">
                            <span class="text-xs font-black text-slate-300 group-hover:text-primary-600 transition-colors">0{{ $i+1 }}</span>
                        </td>
                        <td class="px-6 py-5">
                            <span class="font-black text-slate-800 group-hover:text-primary-800 transition-colors uppercase tracking-tight text-sm">
                                {{ $k->nama }}
                            </span>
                        </td>
                        <td class="px-6 py-5 text-sm">
                            @if($k->tipe == 'benefit')
                                <span class="inline-flex items-center px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest bg-emerald-50 text-emerald-700 border border-emerald-100 shadow-sm shadow-emerald-500/5">
                                    Benefit
                                </span>
                            @else
                                <span class="inline-flex items-center px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest bg-rose-50 text-rose-700 border border-rose-100 shadow-sm shadow-rose-500/5">
                                    Cost / Beban
                                </span>
                            @endif
                        </td>
                        <td class="px-8 py-5 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('kriteria.edit', $k->id) }}" class="w-10 h-10 flex items-center justify-center bg-white border border-indigo-50 rounded-xl text-indigo-600 hover:bg-indigo-600 hover:text-white transition-all shadow-sm hover:shadow-indigo-200 active:scale-95 group/btn" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form action="{{ route('kriteria.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kriteria ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-10 h-10 flex items-center justify-center bg-white border border-rose-50 rounded-xl text-rose-500 hover:bg-rose-500 hover:text-white transition-all shadow-sm hover:shadow-rose-200 active:scale-95 group/btn" title="Hapus">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-20 text-center">
                            <div class="flex flex-col items-center gap-6 opacity-40">
                                <div class="w-20 h-20 bg-slate-100 rounded-[2.5rem] flex items-center justify-center text-slate-400 shadow-inner">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.051.046 2 2 0 01-2.57-1.464l-1.394-5.574a2 2 0 011.463-2.57l5.574-1.394a2 2 0 012.57 1.463l.422 1.688a2 2 0 00.547 1.022l1.688.422a2 2 0 011.463 2.57l-1.394 5.574a2 2 0 01-1.464 2.57l-5.574 1.394a2 2 0 01-2.57-1.463l-1.394-5.574a2 2 0 011.463-2.57l5.574-1.394a2 2 0 012.57 1.463l.422 1.688a2 2 0 00.547 1.022l1.688.422z" />
                                    </svg>
                                </div>
                                <div class="space-y-1">
                                    <span class="font-black uppercase tracking-[0.3em] text-xs text-slate-800">Master Kriteria Kosong</span>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-loose">Belum ada kriteria penilaian yang dikonfigurasi.</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </div>
    </x-card>
</div>
@endsection