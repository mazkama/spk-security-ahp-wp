@extends('layouts.app')

@section('title', 'Detail Periode')

@section('content')
<div class="max-w-2xl mx-auto">
    <x-card>
        <x-slot name="header">
            <div class="flex items-center justify-between w-full">
                <h2 class="text-xl font-bold text-slate-800">Detail Periode Seleksi</h2>
                @if($periode->status=='aktif')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700 border border-emerald-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 me-2 animate-pulse"></span>
                        Aktif
                    </span>
                @elseif($periode->status=='draft')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700 border border-amber-200">
                        Draft
                    </span>
                @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200">
                        Selesai
                    </span>
                @endif
            </div>
        </x-slot>

        <div class="space-y-6">
            <div>
                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Nama Periode</label>
                <p class="text-lg font-bold text-slate-700 leading-tight uppercase">{{ $periode->nama_periode }}</p>
            </div>

            <div class="grid grid-cols-2 gap-8 pt-4 border-t border-slate-50">
                <div>
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] block mb-1">Tanggal Mulai</label>
                    <div class="flex items-center gap-2 text-slate-600 font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ \Carbon\Carbon::parse($periode->tanggal_mulai)->format('d F Y') }}
                    </div>
                </div>
                <div>
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] block mb-1">Tanggal Selesai</label>
                    <div class="flex items-center gap-2 text-slate-600 font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ \Carbon\Carbon::parse($periode->tanggal_selesai)->format('d F Y') }}
                    </div>
                </div>
            </div>

            <div class="pt-8 flex justify-center">
                <a href="{{ route('periode.index') }}" class="px-6 py-3 rounded-xl font-bold text-slate-500 hover:bg-slate-100 transition-all flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Daftar
                </a>
            </div>
        </div>
    </x-card>
</div>
@endsection
