<div class="overflow-x-auto rounded shadow">
    <table {{ $attributes->merge(['class' => 'min-w-full bg-white border border-gray-200']) }}>
        {{ $slot }}
    </table>
</div>
