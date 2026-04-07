<button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-6 py-3 bg-rose-600 border border-transparent rounded-2xl font-bold text-xs text-white uppercase tracking-widest hover:bg-rose-700 active:scale-95 transition-all duration-200 shadow-lg shadow-rose-600/20']) }}>
    {{ $slot }}
</button>
