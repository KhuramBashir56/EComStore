@props(['title', 'button'])
@php
    $color;
    if ($button == 'default') {
        $color = 'text-primary-500 dark:text-secondary-500 hover:text-white dark:hover:text-white hover:bg-primary-500 dark:hover:bg-secondary-500 border-secondary-500 dark:border-secondary-500';
    } elseif ($button == 'red') {
        $color = 'text-red-700 dark:text-red-600 hover:text-white dark:hover:text-white hover:bg-red-700 dark:hover:bg-red-600 border-red-700 dark:border-red-600';
    } elseif ($button == 'green') {
        $color = 'text-green-700 dark:text-green-600 hover:text-white dark:hover:text-white hover:bg-green-700 dark:hover:bg-green-600 border-green-700 dark:border-green-600';
    } elseif ($button == 'blue') {
        $color = 'text-blue-700 dark:text-blue-600 hover:text-white dark:hover:text-white hover:bg-blue-700 dark:hover:bg-blue-600 border-blue-700 dark:border-blue-600';
    }
@endphp
<button {{ $attributes->merge(['class' => 'flex justify-center items-center px-3 border py-1.5 transition-colors duration-500 ' . $color]) }} wire:loading.attr="disabled" wire:offline.attr="disabled" wire:loading.class="cursor-wait">{{ $title ?? $slot }}</button>
