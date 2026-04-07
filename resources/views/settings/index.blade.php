@extends('layouts.app')

@section('title', 'Pengaturan Sistem & Profil')

@section('content')
<div x-data="{ showResetModal: false }" class="space-y-6 sm:space-y-8 animate-fade-in px-2 sm:px-0">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Profile Settings -->
        <div class="space-y-6">
            <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] px-2 flex items-center gap-3">
                <div class="w-2 h-2 rounded-full bg-primary-500"></div>
                Profil Administrator
            </h3>
            
            <x-card class="bg-white/80 backdrop-blur-md border-none shadow-2xl rounded-[2.5rem] p-6 sm:p-10">
                <form action="{{ route('settings.profile.update') }}" method="POST" class="space-y-8">
                    @csrf
                    
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Identitas Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                            class="w-full px-6 py-4 rounded-2xl border-slate-100 bg-white shadow-inner focus:border-primary-500 focus:ring-8 focus:ring-primary-500/10 transition-all font-black text-slate-800 text-sm" required>
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Alamat Email Terdaftar</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                            class="w-full px-6 py-4 rounded-2xl border-slate-100 bg-white shadow-inner focus:border-primary-500 focus:ring-8 focus:ring-primary-500/10 transition-all font-black text-slate-800 text-sm" required>
                    </div>

                    <div class="pt-6 border-t border-slate-50">
                        <h4 class="text-[10px] font-black text-primary-600 uppercase tracking-[0.2em] mb-6 italic italic-black">Security: Update Password</h4>
                        
                        <div class="space-y-6">
                            <div class="space-y-3">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Password Saat Ini</label>
                                <input type="password" name="current_password" 
                                    class="w-full px-6 py-4 rounded-2xl border-slate-100 bg-white shadow-inner focus:border-primary-500 focus:ring-8 focus:ring-primary-500/10 transition-all font-black text-slate-800 text-sm">
                                @error('current_password') <p class="text-rose-500 text-[10px] mt-2 font-bold uppercase tracking-widest">{{ $message }}</p> @enderror
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div class="space-y-3">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Password Baru</label>
                                    <input type="password" name="new_password" 
                                        class="w-full px-6 py-4 rounded-2xl border-slate-100 bg-white shadow-inner focus:border-primary-500 focus:ring-8 focus:ring-primary-500/10 transition-all font-black text-slate-800 text-sm">
                                </div>
                                <div class="space-y-3">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Konfirmasi</label>
                                    <input type="password" name="new_password_confirmation" 
                                        class="w-full px-6 py-4 rounded-2xl border-slate-100 bg-white shadow-inner focus:border-primary-500 focus:ring-8 focus:ring-primary-500/10 transition-all font-black text-slate-800 text-sm">
                                </div>
                            </div>
                            @error('new_password') <p class="text-rose-500 text-[10px] mt-2 font-bold uppercase tracking-widest">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <button type="submit" class="w-full btn-premium bg-primary-600 text-white hover:bg-primary-700 py-5 shadow-2xl shadow-primary-900/10 active:scale-95 group transition-all">
                        <span class="text-[10px] font-black uppercase tracking-[0.3em]">Perbarui Profil Sistem</span>
                    </button>
                </form>
            </x-card>
        </div>

        <!-- System Reset Section -->
        <div class="space-y-6">
            <h3 class="text-xs font-black text-rose-500 uppercase tracking-[0.2em] px-2 flex items-center gap-3">
                <div class="w-2 h-2 rounded-full bg-rose-500"></div>
                Maintenance & Reset
            </h3>

            <x-card class="bg-rose-50 border-none shadow-2xl p-8 sm:p-12 rounded-[2.5rem] relative overflow-hidden group">
                <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-rose-500/[0.03] rounded-full blur-3xl pointer-events-none"></div>
                <div class="flex flex-col items-center sm:items-start sm:flex-row justify-between gap-8 relative z-10">
                    <div class="flex items-center gap-5 text-center sm:text-left">
                        <div class="w-16 h-16 bg-white text-rose-600 rounded-3xl flex items-center justify-center shrink-0 shadow-xl shadow-rose-900/5 group-hover:rotate-12 transition-transform duration-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </div>
                        <div class="space-y-1">
                            <h4 class="text-sm font-black text-rose-900 uppercase tracking-tight italic">Inisialisasi Sistem</h4>
                            <p class="text-[10px] text-rose-700/50 font-bold uppercase tracking-widest leading-relaxed">Hapus seluruh data master, penilaian, dan histori seleksi secara permanen.</p>
                        </div>
                    </div>
                    <button @click="showResetModal = true" class="w-full sm:w-auto px-10 py-5 bg-rose-600 text-white rounded-3xl font-black uppercase tracking-widest text-[10px] hover:bg-rose-700 transition-all shadow-xl shadow-rose-600/20 active:scale-95">
                        Reset Database
                    </button>
                </div>
            </x-card>

            <div class="px-8 py-5 rounded-[2rem] bg-secondary-950 text-white/40 text-[10px] font-bold uppercase tracking-widest flex items-center gap-4 shadow-2xl border border-white/5">
                <svg class="w-4 h-4 text-primary-500 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                <span>Audit Log: Tindakan reset akan dicatat sebagai penghapusan massal oleh <span class="text-primary-400 font-black italic">{{ Auth::user()->name }}</span>.</span>
            </div>
        </div>
    </div>

    <!-- Enhanced Modal Layer -->
    <div x-show="showResetModal" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 pb-20"
        x-transition:enter-end="opacity-100 pb-0"
        x-cloak
        class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-secondary-950/80 backdrop-blur-md"
        style="display: none;">
        
        <div @click.away="showResetModal = false" class="bg-white rounded-[3.5rem] shadow-[0_50px_100px_-20px_rgba(0,0,0,0.5)] max-w-sm w-full p-10 text-center space-y-8 relative overflow-hidden border-8 border-slate-50">
            <div class="w-24 h-24 bg-rose-50 text-rose-500 rounded-[2.5rem] flex items-center justify-center mx-auto shadow-inner group-hover:scale-110 transition-transform">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            
            <div class="space-y-3">
                <h4 class="text-2xl font-black text-slate-800 uppercase tracking-tighter italic">Konfirmasi Reset?</h4>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest leading-relaxed px-2">Tindakan ini permanen. Seluruh parameter seleksi dan kandidat akan dihapus dari server.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <button @click="showResetModal = false" class="py-5 bg-slate-50 text-slate-400 rounded-3xl font-black uppercase tracking-widest text-[9px] hover:bg-slate-100 transition-colors">
                    Batalkan
                </button>
                <form action="{{ route('settings.reset') }}" method="POST">
                    @csrf
                    <input type="hidden" name="confirmation" value="RESET SISTEM">
                    <button type="submit" class="w-full py-5 bg-rose-600 text-white rounded-3xl font-black uppercase tracking-widest text-[9px] hover:bg-rose-700 shadow-xl shadow-rose-600/20 active:scale-95 transition-all">
                        Ya, Eksekusi!
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
