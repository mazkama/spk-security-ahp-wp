<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-900 selection:bg-primary-500 selection:text-white">
        <div class="min-h-screen bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-primary-50 via-slate-50 to-slate-100 flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="mb-8 hidden">
                <a href="/" class="flex flex-col items-center gap-3 group">
                    <x-application-logo class="w-16 h-16 fill-primary-600 transition-transform duration-500 group-hover:rotate-12" />
                    <span class="text-2xl font-black tracking-tighter text-slate-800 uppercase">SPK Security</span>
                </a>
            </div>


            @if(View::hasSection('content'))
                @yield('content')
            @else
                @if(isset($wideContainer) && $wideContainer)
                    {{ $slot }}
                @else
                    <div class="w-full sm:max-w-md px-8 py-10 bg-white/70 backdrop-blur-xl border border-white/20 shadow-2xl overflow-hidden sm:rounded-[2rem] animate-fade-in">
                        {{ $slot }}
                    </div>
                @endif
            @endif

            <div class="mt-8 text-slate-400 text-[10px] font-bold uppercase tracking-[0.2em]">
                &copy; {{ date('Y') }} Sistem Pendukung Keputusan Petugas Keamanan
            </div>
        </div>
    </body>
</html>
