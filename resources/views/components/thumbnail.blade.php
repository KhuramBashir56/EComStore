@props(['url'])
<div {{ $attributes->merge(['class' => 'bg-white ' . ($url ?? 'p-4 dark:bg-gray-500')]) }}>
    <img src="{{ $url ?? asset('assets/images/card-image.svg') }}" alt="Image Thumbnail" class="w-full h-full" loading="lazy">
</div>
