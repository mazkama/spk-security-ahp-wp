<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Selamat Datang</h2>
        <p class="text-sm text-slate-500 font-medium">Silakan masuk untuk mengelola sistem SPK.</p>
    </div>

    <!-- Status Sessi -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Alamat Email -->
        <div class="space-y-1">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Kata Sandi -->
        <div class="space-y-1">
            <div class="flex items-center justify-between">
                <x-input-label for="password" :value="__('Kata Sandi')" />
                @if (Route::has('password.request'))
                    <a class="text-xs font-bold text-primary-600 hover:underline transition-all" href="{{ route('password.request') }}">
                        Lupa sandi?
                    </a>
                @endif
            </div>

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Ingat Saya -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" class="rounded-lg border-slate-200 text-primary-600 shadow-sm focus:ring-primary-500/20 w-5 h-5 transition-all" name="remember">
                <span class="ms-3 text-sm font-bold text-slate-500 group-hover:text-slate-700 transition-colors uppercase tracking-widest text-[10px]">Ingat Saya</span>
            </label>
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full py-4 text-sm tracking-[0.2em]">
                {{ __('Masuk Sekarang') }}
            </x-primary-button>
        </div>

        @if (Route::has('register'))
            <p class="text-center text-xs font-bold text-slate-400 uppercase tracking-widest pt-4">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-primary-600 hover:underline ml-1">Daftar</a>
            </p>
        @endif
    </form>
</x-guest-layout>
