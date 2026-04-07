<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Daftar Akun 🔐</h2>
        <p class="text-sm text-slate-500 font-medium">Buat akun untuk mulai mengelola rekruitmen.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Nama -->
        <div class="space-y-1">
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Masukkan nama lengkap" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Alamat Email -->
        <div class="space-y-1">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Kata Sandi -->
        <div class="space-y-1">
            <x-input-label for="password" :value="__('Kata Sandi')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password"
                            placeholder="Minimal 8 karakter" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Konfirmasi Kata Sandi -->
        <div class="space-y-1">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="Ulangi kata sandi" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-4">
            <x-primary-button class="w-full py-4 text-sm tracking-[0.2em]">
                {{ __('Daftar Sekarang') }}
            </x-primary-button>
        </div>

        <p class="text-center text-xs font-bold text-slate-400 uppercase tracking-widest pt-2">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="text-primary-600 hover:underline ml-1">Masuk</a>
        </p>
    </form>
</x-guest-layout>
