@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-bold text-slate-700 uppercase tracking-widest mb-1']) }}>
    {{ $value ?? $slot }}
</label>
