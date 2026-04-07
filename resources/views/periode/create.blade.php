@extends('layouts.app')

@section('title', 'Buat Periode Baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <x-card>
        <x-slot name="header">
            <h2 class="text-xl font-bold text-slate-800">Tambah Periode Seleksi</h2>
        </x-slot>

        <form action="{{ route('periode.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="space-y-2">
                <label for="nama_periode" class="text-sm font-bold text-slate-700 uppercase tracking-wider">Nama Periode</label>
                <input type="text" name="nama_periode" id="nama_periode" 
                    placeholder="Contoh: Seleksi Petugas Keamanan April 2024"
                    class="w-full px-4 py-3 rounded-xl border-slate-200 focus:border-primary-500 focus:ring focus:ring-primary-500/20 transition-all @error('nama_periode') border-red-500 @enderror" 
                    value="{{ old('nama_periode') }}" required>
                @error('nama_periode')
                    <p class="text-red-500 text-xs font-medium mt-1 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="tanggal_mulai" class="text-sm font-bold text-slate-700 uppercase tracking-wider">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" 
                        class="w-full px-4 py-3 rounded-xl border-slate-200 focus:border-primary-500 focus:ring focus:ring-primary-500/20 transition-all @error('tanggal_mulai') border-red-500 @enderror" 
                        value="{{ old('tanggal_mulai') }}" required>
                    @error('tanggal_mulai')
                        <p class="text-red-500 text-xs font-medium mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="tanggal_selesai" class="text-sm font-bold text-slate-700 uppercase tracking-wider">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" id="tanggal_selesai" 
                        class="w-full px-4 py-3 rounded-xl border-slate-200 focus:border-primary-500 focus:ring focus:ring-primary-500/20 transition-all @error('tanggal_selesai') border-red-500 @enderror" 
                        value="{{ old('tanggal_selesai') }}" required>
                    @error('tanggal_selesai')
                        <p class="text-red-500 text-xs font-medium mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="pt-4 flex items-center justify-between gap-4">
                <a href="{{ route('periode.index') }}" class="px-6 py-3 rounded-xl font-bold text-slate-500 hover:bg-slate-100 transition-all flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Batal
                </a>
                <button type="submit" class="btn-premium bg-primary-600 text-white hover:bg-primary-700 px-8 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Periode
                </button>
            </div>
        </form>
    </x-card>
</div>
@endsection
