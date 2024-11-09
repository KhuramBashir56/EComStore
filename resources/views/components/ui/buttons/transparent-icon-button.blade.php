@props(['title', 'icon', 'button'])
@php
    $color;
    if ($button == 'default') {
        $color = 'bg-transparent text-primary-500 dark:text-secondary-500 hover:text-white dark:hover:text-gray-200 hover:bg-primary-700 dark:hover:bg-secondary-700';
    } elseif ($button == 'red') {
        $color = 'bg-transparent text-red-700 dark:text-red-600 hover:text-white dark:hover:text-gray-200 hover:bg-red-800 dark:hover:bg-red-700';
    } elseif ($button == 'green') {
        $color = 'bg-transparent text-green-700 dark:text-green-600 hover:text-white dark:hover:text-gray-200 hover:bg-green-800 dark:hover:bg-green-700';
    } elseif ($button == 'blue') {
        $color = 'bg-transparent text-blue-700 dark:text-blue-600 hover:text-white dark:hover:text-gray-200 hover:bg-blue-800 dark:hover:bg-blue-700';
    }
@endphp
<button title="{{ $title }}" {{ $attributes->merge(['class' => 'flex justify-center items-center p-1 transition-colors duration-500 ' . $color]) }} wire:loading.attr="disabled" wire:offline.attr="disabled" wire:loading.class="cursor-wait">
    <span class="material-symbols-outlined">{{ $icon }}</span>
</button>
