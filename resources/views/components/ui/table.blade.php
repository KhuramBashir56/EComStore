<div {{ $attributes->merge(['class' => 'shadow-md w-full overflow-x-auto print:text-xs']) }}>
    <table class="w-full">
        {{ $slot }}
    </table>
</div>
