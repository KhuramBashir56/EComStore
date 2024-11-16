@props(['title', 'name', 'for', 'radio'])
@php
    $color;
    if ($radio == 'default') {
        $color = 'text-primary-500 dark:text-secondary-500 checked:bg-primary-500 dark:checked:bg-secondary-500 focus:border-primary-500 dark:focus:border-secondary-500 focus:ring-primary-500 dark:focus:ring-secondary-500';
    } elseif ($radio == 'red') {
        $color = 'text-red-700 dark:text-red-600 checked:bg-red-700 dark:checked:bg-red-600 focus:border-red-700 dark:focus:border-red-600 focus:ring-red-700 dark:focus:ring-red-600';
    } elseif ($radio == 'green') {
        $color = 'text-green-700 dark:text-green-600 checked:bg-green-700 dark:checked:bg-green-600 focus:border-green-700 dark:focus:border-green-600 focus:ring-green-700 dark:focus:ring-green-600';
    } elseif ($radio == 'blue') {
        $color = 'text-blue-700 dark:text-blue-600 checked:bg-blue-700 dark:checked:bg-blue-600 focus:border-blue-700 dark:focus:border-blue-600 focus:ring-blue-700 dark:focus:ring-blue-600';
    }
@endphp

<label for="{{ $for }}" class="inline-flex items-center">
    <input type="radio" id="{{ $for }}" name="{{ $name }}" {{ $attributes->merge(['class' => 'size-5 cursor-pointer rounded-full border border-gray-700 dark:border-gray-400 bg-white dark:bg-gray-500 ' . $color]) }}>
    <span class="ms-2 text-black dark:text-gray-300">{{ $title ?? $slot }}</span>
</label>
