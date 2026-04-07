<div class="relative overflow-x-auto sm:rounded-2xl">
    <table {{ $attributes->merge(['class' => 'w-full text-sm text-left text-slate-500']) }}>
        @if(isset($thead))
            <thead class="text-xs text-slate-700 uppercase bg-slate-50/50 border-b border-slate-100">
                {{ $thead }}
            </thead>
        @endif
        <tbody class="divide-y divide-slate-100">
            {{ $slot }}
        </tbody>
    </table>
</div>
