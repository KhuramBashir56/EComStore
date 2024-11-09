@props(['url'])
<div class="w-fit h-fit" title="Logo">
    <img src="{{ $url ?? asset('assets/images/card-image.svg') }}" {{ $attributes->merge(['class' => 'bg-white']) }} loading="lazy">
</div>
