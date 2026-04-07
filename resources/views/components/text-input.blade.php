@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'px-4 py-3 bg-white/50 backdrop-blur-sm border border-slate-200 focus:border-primary-500 focus:ring focus:ring-primary-500/20 rounded-2xl transition-all duration-200 shadow-sm']) !!}>
