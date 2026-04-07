@extends('layouts.app')

@section('title', 'Manajemen Kandidat')

@section('content')
<div class="space-y-6 sm:space-y-8 animate-fade-in px-2 sm:px-0">
    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6">
        <div class="space-y-1">
            <h1 class="text-2xl sm:text-3xl font-black text-slate-800 uppercase tracking-tighter italic">Daftar Kandidat</h1>
            <p class="text-[10px] sm:text-xs font-bold text-slate-500 uppercase tracking-[0.2em] leading-relaxed">Database calon petugas keamanan yang mengikuti proses seleksi.</p>
        </div>
        <a href="{{ route('kandidat.create') }}" class="btn-premium bg-primary-600 text-white hover:bg-primary-700 flex items-center justify-center gap-3 px-8 py-4 w-full sm:w-auto shadow-xl shadow-primary-900/10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
            </svg>
            <span class="text-[10px] font-black uppercase tracking-[0.2em]">Tambah Kandidat</span>
        </a>
    </div>

    <x-card class="!p-0 border-none shadow-2xl overflow-hidden bg-white/80 backdrop-blur-md">
        <div class="overflow-x-auto custom-scrollbar">
            <x-table class="w-full">
                <x-slot name="thead">
                    <tr class="bg-slate-50/50 border-b border-slate-100 uppercase tracking-[0.2em] text-[10px] font-black text-slate-400">
                        <th class="px-6 py-5 text-center w-16">#</th>
                        <th class="px-6 py-5 text-left">Identitas Kandidat</th>
                        <th class="px-6 py-5 text-center">Periode Seleksi</th>
                        <th class="px-8 py-5 text-right whitespace-nowrap">Aksi Kelola</th>
                    </tr>
                </x-slot>

                @forelse($kandidat as $i => $k)
                    <tr class="group hover:bg-primary-50/30 transition-all duration-300">
                        <td class="px-6 py-5 text-center">
                            <span class="text-xs font-black text-slate-300 group-hover:text-primary-600 transition-colors">0{{ $i+1 }}</span>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-white border border-slate-100 flex items-center justify-center text-[10px] font-black text-slate-400 uppercase tracking-tighter group-hover:bg-primary-600 group-hover:text-white transition-all shadow-sm">
                                    {{ substr($k->nama, 0, 2) }}
                                </div>
                                <span class="font-black text-slate-800 group-hover:text-primary-800 transition-colors uppercase tracking-tight text-sm">
                                    {{ $k->nama }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <span class="inline-flex items-center px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest bg-slate-50 text-slate-600 border border-slate-100 opacity-80">
                                {{ $k->periode->nama_periode ?? '-' }}
                            </span>
                        </td>
                        <td class="px-8 py-5 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('kandidat.edit', $k->id) }}" class="w-10 h-10 flex items-center justify-center bg-white border border-indigo-50 rounded-xl text-indigo-600 hover:bg-indigo-600 hover:text-white transition-all shadow-sm hover:shadow-indigo-200 active:scale-95 group/btn" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form action="{{ route('kandidat.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kandidat ini?')">
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
                            @if($periodeCount == 0)
                                <div class="flex flex-col items-center gap-6 max-w-xs mx-auto">
                                    <div class="w-20 h-20 bg-amber-50 rounded-[2.5rem] flex items-center justify-center text-amber-500 shadow-inner border border-amber-100">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    </div>
                                    <div class="space-y-1">
                                        <h4 class="text-sm font-black text-slate-800 uppercase tracking-tight italic">Periode Tidak Ditemukan</h4>
                                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest leading-loose">Anda harus membuat periode seleksi terlebih dahulu sebelum dapat mendaftarkan kandidat.</p>
                                    </div>
                                    <a href="{{ route('periode.create') }}" class="px-10 py-4 bg-amber-500 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-amber-600 transition-all shadow-xl shadow-amber-500/20">
                                        Buat Periode Baru
                                    </a>
                                </div>
                            @else
                                <div class="flex flex-col items-center gap-6 opacity-40">
                                    <div class="w-20 h-20 bg-slate-100 rounded-[2.5rem] flex items-center justify-center text-slate-400 shadow-inner">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                    </div>
                                    <div class="space-y-1">
                                        <span class="font-black uppercase tracking-[0.3em] text-xs text-slate-800">Database Kandidat Kosong</span>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-loose">Belum ada kandidat yang terdaftar dalam sistem.</p>
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </div>
    </x-card>
</div>
@endsection