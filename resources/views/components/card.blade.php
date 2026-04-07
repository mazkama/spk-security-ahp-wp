<div {{ $attributes->merge(['class' => 'glass-card rounded-2xl overflow-hidden']) }}>
    @if(isset($header))
        <div class="px-4 py-3 sm:px-6 sm:py-4 border-b border-slate-100 flex items-center justify-between">
            {{ $header }}
        </div>
    @endif

    <div class="p-4 sm:p-8">
        {{ $slot }}
    </div>

    @if(isset($footer))
        <div class="px-4 py-3 sm:px-6 sm:py-4 bg-slate-50 border-t border-slate-100">
            {{ $footer }}
        </div>
    @endif
</div>
