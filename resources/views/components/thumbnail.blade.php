@props(['path', 'alt'])
<div {{ $attributes->merge(['class' => 'bg-white']) }}>
    <img src="{{ $path }}" alt="{{ $alt ?? 'image / thumbnail' }}" class="w-full h-full" loading="lazy">
</div>
