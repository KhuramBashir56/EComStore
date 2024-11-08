@props(['title'])
<div {{ $attributes->merge(['class' => 'px-4 py-0.5 text-white dark:text-gray-200 bg-secondary-300 dark:bg-gray-700']) }}>{{ $title }}</div>
