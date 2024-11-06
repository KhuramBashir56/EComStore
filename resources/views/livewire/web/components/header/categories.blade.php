<div class="flex sm:max-w-sm w-full relative" x-data="{ categories: false }">
    <button x-on:click="categories = !categories" x-on:click.away="categories = false" class="flex items-center justify-between gap-1 bg-primary-500 hover:bg-primary-700 dark:bg-secondary-500 dark:hover:bg-secondary-700 transition-colors duration-500 px-3 py-1.5 w-full" title="All Categories">
        <span class="truncate w-fit uppercase font-bold">All Categories</span>
        <span class="material-symbols-outlined mt-1">expand_more</span>
    </button>
    <ul x-show="categories" x-transition x-transition:enter.duration.500ms x-collapse class="list-none w-full absolute left-0 top-full font-medium bg-white shadow-md divide-y divide-gray-300 dark:divide-gray-700 dark:bg-gray-900 text-gray-900 dark:text-gray-200 border border-gray-300 dark:border-gray-700" style="display: none;">
        <li>
            <a href="" class="block px-3 py-1.5 hover:bg-secondary-500 dark:hover:bg-gray-700 hover:text-white transition-colors duration-500">home</a>
        </li>
        <li>
            <a href="" class="block px-3 py-1.5 hover:bg-secondary-500 dark:hover:bg-gray-700 hover:text-white transition-colors duration-500">home</a>
        </li>
        <li>
            <a href="" class="block px-3 py-1.5 hover:bg-secondary-500 dark:hover:bg-gray-700 hover:text-white transition-colors duration-500">home</a>
        </li>
        <li>
            <a href="" class="block px-3 py-1.5 hover:bg-secondary-500 dark:hover:bg-gray-700 hover:text-white transition-colors duration-500">home</a>
        </li>
        <li>
            <a href="" class="block px-3 py-1.5 hover:bg-secondary-500 dark:hover:bg-gray-700 hover:text-white transition-colors duration-500">about</a>
        </li>
    </ul>
</div>
