@props(['index', 'title', 'icon'])
<div {{ $attributes->merge(['class' => 'flex justify-center items-center md:gap-1.5 font-bold', 'title' => $title]) }}>
    <span class="flex justify-center items-center size-7 border-2 border-current rounded-full text-lg">{{ $index }}</span>
    <span class="md:inline hidden text-current">{{ $title }}</span>
    <span class="material-symbols-outlined mt-1 text-current">{{ $icon ?? '' }}</span>
</div>
