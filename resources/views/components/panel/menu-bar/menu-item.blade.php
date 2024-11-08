@props(['title', 'active', 'icon'])
<a {{ $attributes }} wire:navigate class="w-full px-4 py-1.5 flex items-center gap-3 transition-colors duration-500 {{ request()->routeIs(explode(' ', $active)) ? 'bg-gray-200 dark:bg-gray-900  text-primary-500 dark:text-secondary-500' : 'text-white dark:text-gray-200 bg-secondary-500 dark:bg-gray-800 hover:bg-secondary-700 dark:hover:bg-gray-700 hover:text-white dark:hover:text-gray-200' }}" title="{{ $title }}">
    <span class="material-symbols-outlined text-2xl">{{ $icon }}</span>
    <span class="font-semibold text-md">{{ $title }}</span>
</a>
