@props(['title', 'icon', 'link'])
@php
    $color;
    if ($link == 'default') {
        $color = 'bg-primary-500 dark:bg-secondary-500 hover:bg-primary-700 dark:hover:bg-secondary-700';
    } elseif ($link == 'red') {
        $color = 'bg-red-700 dark:bg-red-600 hover:bg-red-800 dark:hover:bg-red-700';
    } elseif ($link == 'green') {
        $color = 'bg-green-700 dark:bg-green-600 hover:bg-green-800 dark:hover:bg-green-700';
    } elseif ($link == 'blue') {
        $color = 'bg-blue-700 dark:bg-blue-600 hover:bg-blue-800 dark:hover:bg-blue-700';
    }
@endphp
<a title="{{ $title }}" {{ $attributes->merge(['class' => 'flex justify-center items-center p-1 text-white hover:transition-colors hover:duration-500 ' . $color]) }}>
    <span class="material-symbols-outlined">{{ $icon }}</span>
</a>
