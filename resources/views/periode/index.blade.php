@extends('layouts.app')

@section('title', 'Manajemen Periode')

@section('content')
<div class="space-y-6 sm:space-y-8 animate-fade-in px-2 sm:px-0">
    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6">
        <div class="space-y-1">
            <h1 class="text-2xl sm:text-3xl font-black text-slate-800 uppercase tracking-tighter italic">Periode Seleksi</h1>
            <p class="text-[10px] sm:text-xs font-bold text-slate-500 uppercase tracking-[0.2em] leading-relaxed">Kelola periode aktif dan histori seleksi petugas keamanan.</p>
        </div>
        <a href="{{ route('periode.create') }}" class="btn-premium bg-primary-600 text-white hover:bg-primary-700 flex items-center justify-center gap-3 px-8 py-4 w-full sm:w-auto shadow-xl shadow-primary-900/10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
            </svg>
            <span class="text-[10px] font-black uppercase tracking-[0.2em]">Tambah Periode</span>
        </a>
    </div>

    <x-card class="!p-0 border-none shadow-2xl overflow-hidden bg-white/80 backdrop-blur-md">
        <div class="overflow-x-auto custom-scrollbar">
            <x-table class="w-full">
                <x-slot name="thead">
                    <tr class="bg-slate-50/50 border-b border-slate-100 uppercase tracking-[0.2em] text-[10px] font-black text-slate-400">
                        <th class="px-6 py-5 text-center w-16">#</th>
                        <th class="px-6 py-5 text-left">Nama Periote</th>
                        <th class="px-6 py-5 text-left min-w-[200px]">Jadwal</th>
                        <th class="px-6 py-5 text-center">Status</th>
                        <th class="px-8 py-5 text-right whitespace-nowrap">Aksi Kelola</th>
                    </tr>
                </x-slot>

                @forelse($periodes as $i => $p)
                    <tr class="group hover:bg-primary-50/30 transition-all duration-300">
                        <td class="px-6 py-5 text-center">
                            <span class="text-xs font-black text-slate-300 group-hover:text-primary-600 transition-colors">0{{ $i+1 }}</span>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex flex-col">
                                <span class="font-black text-slate-800 group-hover:text-primary-800 transition-colors uppercase tracking-tight text-sm">
                                    {{ $p->nama_periode }}
                                </span>
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1">ID: PER-{{ str_pad($p->id, 4, '0', STR_PAD_LEFT) }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-2 text-[10px] font-black text-slate-600 uppercase tracking-widest">
                                 <span class="bg-white px-2 py-1 rounded-lg border border-slate-100 shadow-sm">{{ \Carbon\Carbon::parse($p->tanggal_mulai)->format('d M y') }}</span>
                                 <span class="text-slate-300 font-normal">to</span> 
                                 <span class="bg-white px-2 py-1 rounded-lg border border-slate-100 shadow-sm">{{ \Carbon\Carbon::parse($p->tanggal_selesai)->format('d M y') }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-5 text-center">
                            @if($p->status=='aktif')
                                <span class="inline-flex items-center px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest bg-emerald-50 text-emerald-700 border border-emerald-100 shadow-sm shadow-emerald-500/5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 me-2 animate-pulse shadow-[0_0_8px_rgba(16,185,129,0.5)]"></span>
                                    Aktif
                                </span>
                            @elseif($p->status=='draft')
                                <span class="inline-flex items-center px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest bg-amber-50 text-amber-700 border border-amber-100 shadow-sm shadow-amber-500/5">
                                    Drafting
                                </span>
                            @else
                                <span class="inline-flex items-center px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest bg-slate-50 text-slate-600 border border-slate-100 opacity-60">
                                    Selesai
                                </span>
                            @endif
                        </td>
                        <td class="px-8 py-5 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-3 translate-x-2">
                                @if($p->status !== 'aktif' && $p->status !== 'selesai')
                                    <form action="{{ route('periode.set-aktif', $p->id) }}" method="POST" onsubmit="return confirm('Jadikan periode ini sebagai periode seleksi aktif?')">
                                        @csrf
                                        <button class="w-9 h-9 flex items-center justify-center bg-white border border-emerald-100 rounded-xl text-emerald-600 hover:bg-emerald-600 hover:text-white transition-all shadow-sm hover:shadow-emerald-200 active:scale-95 group/btn" title="Set Aktif">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif

                                @if($p->status == 'aktif')
                                    <form action="{{ route('periode.lock', $p->id) }}" method="POST" onsubmit="return confirm('Kunci periode ini? Pembaharuan data akan dinonaktifkan.')">
                                        @csrf
                                        <button class="w-9 h-9 flex items-center justify-center bg-white border border-amber-100 rounded-xl text-amber-600 hover:bg-amber-600 hover:text-white transition-all shadow-sm hover:shadow-amber-200 active:scale-95 group/btn" title="Lock Periode">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0H10m11-3V7a2 2 0 00-2-2H5a2 2 0 00-2-2v10a2 2 0 002 2h14a2 2 0 002-2v-4z" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif

                                @if($p->status != 'selesai')
                                    <a href="{{ route('periode.edit', $p->id) }}" class="w-9 h-9 flex items-center justify-center bg-white border border-indigo-50 rounded-xl text-indigo-600 hover:bg-indigo-600 hover:text-white transition-all shadow-sm hover:shadow-indigo-200 active:scale-95 group/btn" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </a>
                                @endif

                                @if($p->status != 'selesai' && $p->kandidat_count == 0)
                                    <form action="{{ route('periode.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus periode ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-9 h-9 flex items-center justify-center bg-white border border-rose-50 rounded-xl text-rose-500 hover:bg-rose-500 hover:text-white transition-all shadow-sm hover:shadow-rose-200 active:scale-95 group/btn" title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif

                                <a href="{{ route('periode.show', $p->id) }}" class="w-9 h-9 flex items-center justify-center bg-primary-600 rounded-xl text-white hover:bg-primary-700 transition-all shadow-lg shadow-primary-900/20 active:scale-95 group/btn" title="Detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center">
                            <div class="flex flex-col items-center gap-6 opacity-40">
                                <div class="w-20 h-20 bg-slate-100 rounded-[2.5rem] flex items-center justify-center text-slate-400 shadow-inner">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="space-y-1">
                                    <span class="font-black uppercase tracking-[0.3em] text-xs text-slate-800">Riwayat Kosong</span>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-loose">Belum ada periode seleksi yang terdaftar dalam sistem.</p>
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