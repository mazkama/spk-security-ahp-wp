<!-- Sidebar Overlay for Mobile -->
<div x-show="sidebarOpen" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @click="sidebarOpen = false" 
     class="fixed inset-0 z-30 bg-slate-900/60 backdrop-blur-sm lg:hidden"></div>

<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
       class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform lg:translate-x-0 bg-secondary-900 text-slate-300" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto border-r border-secondary-800">
        <div class="flex items-center ps-2.5 mb-10 mt-2">
            <x-application-logo class="h-8 me-3 fill-primary-500" />
            <span class="self-center text-xl font-bold whitespace-nowrap text-white">SPK Security</span>
        </div>
        
        <ul class="space-y-2 font-medium">

            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center p-3 rounded-xl hover:bg-secondary-800 transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/20' : '' }}">
                    <svg class="w-5 h-5 transition duration-75 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    <span class="ms-3">Beranda</span>
                </a>
            </li>

            <div class="pt-4 pb-2 px-3 text-[10px] font-bold uppercase tracking-wider text-secondary-500">
                Data Master
            </div>

            <li>
                <a href="{{ route('periode.index') }}" class="flex items-center p-3 rounded-xl hover:bg-secondary-800 transition-all duration-200 group {{ request()->routeIs('periode.*') ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/20' : '' }}">
                    <svg class="w-5 h-5 transition duration-75 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                    <span class="ms-3">Periode Seleksi</span>
                </a>
            </li>

            <li>
                <a href="{{ route('kriteria.index') }}" class="flex items-center p-3 rounded-xl hover:bg-secondary-800 transition-all duration-200 group {{ request()->routeIs('kriteria.*') ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/20' : '' }}">
                    <svg class="w-5 h-5 transition duration-75 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                    <span class="ms-3">Kriteria</span>
                </a>
            </li>

            <li>
                <a href="{{ route('kandidat.index') }}" class="flex items-center p-3 rounded-xl hover:bg-secondary-800 transition-all duration-200 group {{ request()->routeIs('kandidat.*') ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/20' : '' }}">
                    <svg class="w-5 h-5 transition duration-75 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                    <span class="ms-3">Data Kandidat</span>
                </a>
            </li>

            <div class="pt-4 pb-2 px-3 text-[10px] font-bold uppercase tracking-wider text-secondary-500">
                Proses SPK
            </div>

            <li>
                <a href="{{ route('perbandingan-kriteria.index') }}" class="flex items-center p-3 rounded-xl hover:bg-secondary-800 transition-all duration-200 group {{ request()->routeIs('perbandingan-kriteria.*') ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/20' : '' }}">
                    <svg class="w-5 h-5 transition duration-75 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                    </svg>
                    <span class="ms-3">Hitung Bobot (AHP)</span>
                </a>
            </li>

            <li>
                <a href="{{ route('penilaian.index') }}" class="flex items-center p-3 rounded-xl hover:bg-secondary-800 transition-all duration-200 group {{ request()->routeIs('penilaian.*') ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/20' : '' }}">
                    <svg class="w-5 h-5 transition duration-75 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V12.75A2.25 2.25 0 0118 15H11.25M8.25 8.25H6a2.25 2.25 0 00-2.25 2.25v6.108c0 1.135.845 2.098 1.976 2.192.373.03.748.057 1.123.08M15.75 18H18a2.25 2.25 0 002.25-2.25V14.25" />
                    </svg>
                    <span class="ms-3">Penilaian Kandidat</span>
                </a>
            </li>

            <li>
                <a href="{{ route('hasil-ranking.index') }}" class="flex items-center p-3 rounded-xl hover:bg-secondary-800 transition-all duration-200 group {{ request()->routeIs('hasil-ranking.*') ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/20' : '' }}">
                    <svg class="w-5 h-5 transition duration-75 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V19.875c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                    </svg>
                    <span class="ms-3">Hasil Ranking (WP)</span>
                </a>
            </li>

            <div class="pt-4 pb-2 px-3 text-[10px] font-bold uppercase tracking-wider text-secondary-500">
                Lainnya
            </div>

            <li>
                <a href="{{ route('settings.index') }}" class="flex items-center p-3 rounded-xl hover:bg-secondary-800 transition-all duration-200 group {{ request()->routeIs('settings.*') ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/20' : '' }}">
                    <svg class="w-5 h-5 transition duration-75 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.59c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.59c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="ms-3">Pengaturan</span>
                </a>
            </li>
        </ul>

        <div class="mt-auto pt-10 pb-4">
             <!-- User Profile Summary -->
             <div class="p-4 rounded-2xl bg-secondary-800 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-primary-600 flex items-center justify-center text-white font-bold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="flex-1 overflow-hidden">
                    <p class="text-sm font-bold text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-secondary-400 truncate">{{ Auth::user()->email }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="p-2 hover:bg-secondary-700 rounded-lg transition-colors text-secondary-400 hover:text-red-400">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                    </button>
                </form>
             </div>
        </div>
    </div>
</aside>
