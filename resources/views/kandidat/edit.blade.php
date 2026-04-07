@extends('layouts.app')

@section('title', 'Edit Kandidat')

@section('content')
<div class="max-w-2xl mx-auto">
    <x-card>
        <x-slot name="header">
            <h2 class="text-xl font-bold text-slate-800 uppercase tracking-tight">Edit Kandidat</h2>
        </x-slot>

        <form action="{{ route('kandidat.update', $kandidat->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')
            
            <div class="space-y-2">
                <x-input-label for="nama" value="Nama Lengkap Kandidat" />
                <x-text-input type="text" name="nama" id="nama" 
                    placeholder="Masukkan nama lengkap"
                    class="w-full" 
                    value="{{ old('nama', $kandidat->nama) }}" required />
                <x-input-error :messages="$errors->get('nama')" class="mt-2" />
            </div>

            <div class="space-y-2">
                <x-input-label for="periode_id" value="Periode Seleksi" />
                <select name="periode_id" id="periode_id" class="w-full px-4 py-3 bg-white/50 backdrop-blur-sm border border-slate-200 focus:border-primary-500 focus:ring focus:ring-primary-500/20 rounded-2xl transition-all duration-200 shadow-sm font-sans" required>
                    @foreach($periode as $p)
                        <option value="{{ $p->id }}" {{ old('periode_id', $kandidat->periode_id) == $p->id ? 'selected' : '' }}>
                            {{ $p->nama_periode }} ({{ $p->status }})
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('periode_id')" class="mt-2" />
            </div>

            <div class="pt-4 flex items-center justify-between gap-4">
                <a href="{{ route('kandidat.index') }}" class="px-6 py-3 rounded-2xl font-bold text-slate-500 hover:bg-slate-100 transition-all flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Batal
                </a>
                <x-primary-button class="px-8 py-3 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Perbarui Kandidat
                </x-primary-button>
            </div>
        </form>
    </x-card>
</div>
@endsection
