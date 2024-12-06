@props(['path', 'alt'])
<div {{ $attributes->merge(['class' => 'bg-white shrink-0']) }}>
    <img src="{{ $path }}" alt="{{ $alt }}" class="w-full h-full" loading="lazy">
</div>
