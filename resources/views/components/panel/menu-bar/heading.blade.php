@props(['title'])
<div {{ $attributes->merge(['class' => 'px-4 py-0.5 text-white dark:text-gray-200 bg-secondary-200 dark:bg-gray-600']) }}>{{ $title }}</div>
