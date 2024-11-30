@props(['title', 'active', 'icon'])
<li class="main-item list-none">
    <button type="button" class="flex px-4 py-1.5 items-center justify-between w-full hover:transition-colors hover:duration-500 {{ request()->routeIs(explode(' ', $active)) ? 'bg-primary-500 text-white' : 'hover:bg-primary-600 hover:text-white' }}" title="{{ $title }}">
        <span class="flex items-center gap-3">
            <span class="material-symbols-outlined text-3xl">{{ $icon }}</span>
            <span class="font-semibold text-md">{{ $title }}</span>
        </span>
        <span class="arrow material-symbols-outlined transition-all duration-500 -rotate-90 {{ request()->routeIs(explode(' ', $active)) ? 'rotate-0' : '' }}">expand_more</span>
    </button>
    <ul class="{{ request()->routeIs(explode(' ', $active)) ? '' : 'hidden' }} divide-y-2 divide-primary-500 sub-menu overflow-hidden text-primary-500 shadow-inner bg-white border-t-2 border-primary-500">
        {{ $slot }}
    </ul>
</li>
