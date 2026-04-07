@extends('layouts.app')

@section('title', 'Edit Periode')

@section('content')
<div class="max-w-2xl mx-auto">
    <x-card>
        <x-slot name="header">
            <h2 class="text-xl font-black text-slate-800 uppercase tracking-tight flex items-center gap-3">
                <div class="p-2 bg-primary-100 text-primary-600 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                Edit Periode Seleksi
            </h2>
        </x-slot>

        <form action="{{ route('periode.update', $periode->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-2">
                <label for="nama_periode" class="text-xs font-black text-slate-500 uppercase tracking-[0.2em]">Nama Periode</label>
                <input type="text" name="nama_periode" id="nama_periode" 
                    placeholder="Contoh: Seleksi Petugas Keamanan April 2024"
                    class="w-full px-4 py-3 rounded-xl border-slate-200 focus:border-primary-500 focus:ring focus:ring-primary-500/20 transition-all font-bold text-slate-700 @error('nama_periode') border-red-500 @enderror" 
                    value="{{ old('nama_periode', $periode->nama_periode) }}" required>
                @error('nama_periode')
                    <p class="text-red-500 text-[10px] font-bold uppercase tracking-widest mt-2 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="tanggal_mulai" class="text-xs font-black text-slate-500 uppercase tracking-[0.2em]">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" 
                        class="w-full px-4 py-3 rounded-xl border-slate-200 focus:border-primary-500 focus:ring focus:ring-primary-500/20 transition-all font-bold text-slate-700 @error('tanggal_mulai') border-red-500 @enderror" 
                        value="{{ old('tanggal_mulai', $periode->tanggal_mulai) }}" required>
                    @error('tanggal_mulai')
                        <p class="text-red-500 text-[10px] font-bold uppercase tracking-widest mt-2 font-medium mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="tanggal_selesai" class="text-xs font-black text-slate-500 uppercase tracking-[0.2em]">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" id="tanggal_selesai" 
                        class="w-full px-4 py-3 rounded-xl border-slate-200 focus:border-primary-500 focus:ring focus:ring-primary-500/20 transition-all font-bold text-slate-700 @error('tanggal_selesai') border-red-500 @enderror" 
                        value="{{ old('tanggal_selesai', $periode->tanggal_selesai) }}" required>
                    @error('tanggal_selesai')
                        <p class="text-red-500 text-[10px] font-bold uppercase tracking-widest mt-2 font-medium mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="p-4 rounded-2xl bg-amber-50 border border-amber-100 flex items-start gap-4">
                <div class="p-2 bg-amber-100 text-amber-600 rounded-lg shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-xs font-black text-amber-900 uppercase tracking-tight">Perhatian Modifikasi</h4>
                    <p class="text-[10px] text-amber-700/70 font-medium mt-1 uppercase tracking-widest leading-relaxed">Perubahan nama atau jadwal tidak akan mempengaruhi data penilaian yang sudah ada selama periode belum dikunci.</p>
                </div>
            </div>

            <div class="pt-4 flex items-center justify-between gap-4">
                <a href="{{ route('periode.index') }}" class="px-8 py-3 rounded-xl font-bold text-slate-500 hover:bg-slate-100 transition-all flex items-center gap-2 uppercase tracking-widest text-[10px]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Batal
                </a>
                <button type="submit" class="btn-premium bg-primary-600 text-white hover:bg-primary-700 px-10 py-4 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </x-card>
</div>
@endsection
