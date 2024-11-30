<header class="bg-secondary-500 dark:bg-gray-900 text-white dark:text-gray-200 divide-y divide-secondary-100 dark:divide-gray-700">
    <section class="px-4">
        <div class="2xl:container mx-auto">
            <div class="flex md:flex-row flex-col gap-1 justify-center md:justify-between items-center py-1">
                <p class="flex items-center max-w-full md:order-none order-1 md:justify-start justify-center">
                    <strong>Laravel: </strong>
                    <span class="truncate w-full overflow-x-hidden">this the text ote this the text note.</span>
                </p>
                <div class="list-none flex divide-x divide-secondary-100 dark:divide-gray-700">
                    <label class="inline-flex items-center cursor-pointer me-3" x-data="{ darkMode: localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches) }" x-cloak x-init="document.body.classList.toggle('dark', darkMode);
                    $watch('darkMode', value => {
                        localStorage.setItem('theme', value ? 'dark' : 'light');
                        document.body.classList.toggle('dark', value);
                    });" x-bind:title="darkMode ? 'Switch to light mode' : 'Switch to dark mode'">
                        <input type="checkbox" value="" class="sr-only peer" x-model="darkMode">
                        <div class="relative w-11 h-6 bg-gray-700 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:hover:bg-gray-100 after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-secondary-500">
                            <div class="absolute top-1/2 -translate-y-1/2 left-0 flex items-center justify-between w-full px-1 text-white">
                                <span class="material-symbols-outlined text-sm">light_mode</span>
                                <span class="material-symbols-outlined text-sm">dark_mode</span>
                            </div>
                        </div>
                    </label>
                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-block px-3 py-1 hover:bg-secondary-700 dark:hover:bg-gray-700 hover:transition-colors hover:duration-500">Dashboard</a>
                    @else
                        <a wire:navigate href="{{ route('login') }}" class="inline-block px-3 py-1 hover:bg-secondary-700 dark:hover:bg-gray-700 hover:transition-colors hover:duration-500">Login</a>
                        <a wire:navigate href="{{ route('register') }}" class="inline-block px-3 py-1 hover:bg-secondary-700 dark:hover:bg-gray-700 hover:transition-colors hover:duration-500">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </section>
    <section class="p-4">
        <div class="2xl:container mx-auto">
            <div class="grid md:grid-cols-4 xs:grid-cols-2  gap-4">
                <div class="flex items-center xs:justify-start justify-center">
                    <x-logo wire:navigate class="size-20" />
                </div>
                <div class="xs:col-span-2 flex items-center">
                    <livewire:web.components.header.search-box />
                </div>
                <div class="md:col-start-4 xs:col-start-2 xs:row-start-1 xs:row-end-2 flex items-center xs:justify-end justify-center">
                    <button title="My Cart" class="flex justify-center items-center p-3 hover:bg-secondary-700 dark:hover:bg-gray-700 hover:transition-colors hover:duration-500 relative rounded-full">
                        <span class="material-symbols-outlined">shopping_cart</span>
                        <span class="absolute top-1 right-1 size-4 rounded-full bg-primary-500 text-white dark:bg-secondary-500 text-[11px] flex justify-center items-center">45</span>
                    </button>
                    <button title="Wishlist" class="flex justify-center items-center p-3 hover:bg-secondary-700 dark:hover:bg-gray-700 hover:transition-colors hover:duration-500 relative rounded-full">
                        <span class="material-symbols-outlined">favorite</span>
                        <span class="absolute top-1 right-1 size-4 rounded-full bg-primary-500 text-white dark:bg-secondary-500 text-[11px] flex justify-center items-center">45</span>
                    </button>
                    <button title="Wishlist" class="flex justify-center items-center p-3 hover:bg-secondary-700 dark:hover:bg-gray-700 hover:transition-colors hover:duration-500 rounded-full">
                        <span class="material-symbols-outlined">account_circle</span>
                    </button>
                </div>
            </div>
        </div>
    </section>
    <x-web.main-menu />
</header>
