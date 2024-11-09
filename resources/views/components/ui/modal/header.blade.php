@props(['title'])
<div class="relative p-4 bg-secondary-500 dark:bg-gray-800 rounded-t-lg dark:rounded-t-xl">
    <h2 class="text-white text-lg font-semibold">{{ $title }}</h2>
    {{ $slot }}
</div>
