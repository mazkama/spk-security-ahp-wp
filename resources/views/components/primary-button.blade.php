<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-premium bg-primary-600 text-white hover:bg-primary-700 shadow-lg shadow-primary-600/20 active:scale-95 transition-all duration-200']) }}>
    {{ $slot }}
</button>
