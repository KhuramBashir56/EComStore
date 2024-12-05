@props(['title'])
<div class="w-full flex justify-between items-center border-b-4 border-gray-400 mb-1">
    <h3 {{ $attributes->merge(['class' => 'w-fit border-b-4 -mb-1 font-medium pb-3']) }}>
        {{ $title }}
    </h3>
    {{ $slot }}
</div>
