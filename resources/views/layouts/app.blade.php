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
    <body x-data="{ sidebarOpen: false }" class="font-sans antialiased bg-slate-50 text-slate-900 selection:bg-primary-500 selection:text-white">
        <div class="min-h-screen bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-primary-50 via-slate-50 to-slate-100 overflow-x-hidden">
            @include('layouts.sidebar')

            <div class="p-4 lg:ml-64 min-h-screen transition-all duration-300">
                <!-- Top Header / Search / Notifications Placeholder -->
                <header class="flex items-center justify-between mb-8 px-4 py-3 glass-card rounded-2xl mx-auto max-w-7xl border border-white/50 shadow-xl shadow-primary-900/5 mt-2">
                    <div class="flex items-center gap-4">
                        <button @click="sidebarOpen = !sidebarOpen" type="button" class="inline-flex items-center p-2 text-sm text-slate-500 rounded-xl lg:hidden hover:bg-white hover:text-primary-600 transition-all focus:outline-none focus:ring-4 focus:ring-primary-500/10">
                            <span class="sr-only">Open sidebar</span>
                            <svg class="w-6 h-6" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                               <path x-show="!sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                               <path x-show="sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        <h2 class="text-base sm:text-lg font-black text-slate-800 uppercase tracking-tight">
                            @yield('title', 'System SPK Security')
                        </h2>
                    </div>
                    
                    <div class="flex items-center gap-3">
                        <div class="hidden sm:block text-right mr-2">
                            <p class="text-xs font-bold text-slate-800">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] text-slate-500 uppercase tracking-widest">Administrator</p>
                        </div>
                    </div>
                </header>

                <!-- Session Status / Alerts -->
                <div class="max-w-7xl mx-auto mb-8 px-4 animate-fade-in-up">
                    @if (session('success'))
                        <div class="flex items-center p-4 text-emerald-800 rounded-2xl bg-emerald-50/50 backdrop-blur-sm border border-emerald-100 shadow-sm shadow-emerald-500/5">
                            <div class="p-2 bg-emerald-100 text-emerald-600 rounded-lg mr-4">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div class="flex items-center justify-between w-full">
                                <div class="text-xs font-black uppercase tracking-widest">{{ session('success') }}</div>
                                <div class="text-[10px] font-bold opacity-30 uppercase tracking-widest">{{ now()->format('H:i') }}</div>
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="flex items-center p-4 text-rose-800 rounded-2xl bg-rose-50/50 backdrop-blur-sm border border-rose-100 shadow-sm shadow-rose-500/5">
                            <div class="p-2 bg-rose-100 text-rose-600 rounded-lg mr-4">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            </div>
                            <div class="flex items-center justify-between w-full">
                                <div class="text-xs font-black uppercase tracking-widest">{{ session('error') }}</div>
                                <div class="text-[10px] font-bold opacity-30 uppercase tracking-widest">{{ now()->format('H:i') }}</div>
                            </div>
                        </div>
                    @endif

                    @if (session('warning'))
                        <div class="flex items-center p-4 text-amber-800 rounded-2xl bg-amber-50/50 backdrop-blur-sm border border-amber-100 shadow-sm shadow-amber-500/5">
                            <div class="p-2 bg-amber-100 text-amber-600 rounded-lg mr-4">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div class="flex items-center justify-between w-full">
                                <div class="text-xs font-black uppercase tracking-widest">{{ session('warning') }}</div>
                                <div class="text-[10px] font-bold opacity-30 uppercase tracking-widest">{{ now()->format('H:i') }}</div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Page Content -->
                <main class="max-w-7xl mx-auto">
                    @yield('content')
                </main>
            </div>
        </div>
    </body>
</html>
