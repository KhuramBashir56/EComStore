<div class="flex w-full max-w-lg mx-auto border-2 border-primary-500 dark:border-secondary-500">
    <input type="search" name="search" id="search" class="w-full px-3 py-1.5 focus:outline-none focus:ring-0 border-none focus:border-none bg-gray-100 focus:bg-white transition-colors duration-500 text-gray-950 text-2xl" placeholder="Start typing to search...">
    <x-ui.buttons.icon-button type="button" :button="__('default')" wire:click="search" :title="__('Search')" :icon="__('search')" />

    {{-- <button class="flex items-center justify-center px-3 py-1.5 bg-primary-500 dark:bg-secondary-500 hover:bg-primary-700 dark:hover:bg-secondary-700 transition-colors duration-500" title="Search">
        <span class="material-symbols-outlined">search</span>
    </button> --}}
</div>
