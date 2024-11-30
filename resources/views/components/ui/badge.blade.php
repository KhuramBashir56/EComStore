@props(['content', 'badge'])
@php
    $color;
    if ($badge == 'default') {
        $color = 'bg-gray-300 text-gray-900 dark:bg-gray-700 dark:text-gray-200';
    } elseif ($badge == 'red') {
        $color = 'bg-red-300 text-red-900 dark:bg-red-900 dark:text-red-200';
    } elseif ($badge == 'green') {
        $color = 'bg-green-300 text-green-900 dark:bg-green-900 dark:text-green-200';
    } elseif ($badge == 'blue') {
        $color = 'bg-blue-300 text-blue-900 dark:bg-blue-900 dark:text-blue-200';
    }
@endphp
<span {{ $attributes->merge(['class' => 'text-sm flex items-center w-fit gap-3 font-medium me-2 px-2.5 py-0.5 rounded-md hover:transition-colors hover:duration-500 ' . $color]) }}>{{ $content ?? $slot }}</span>
