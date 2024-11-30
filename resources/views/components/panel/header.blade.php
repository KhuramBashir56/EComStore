<header class="p-4 text-white dark:text-gray-200 bg-secondary-500 dark:bg-gray-800 flex items-center gap-4 shadow-xl z-10 print:hidden">
    <button onclick="menuRToggle()" class="sidebarToggle xl:hidden flex justify-center items-center p-3 hover:bg-secondary-700 dark:hover:bg-gray-700 hover:transition-colors hover:duration-500" title="Toggle Menu">
        <span class="material-symbols-outlined">menu</span>
    </button>
    <div class="flex justify-center items-center gap-4">
        <x-logo class="size-10 bg-white" />
        <span class="sm:inline hidden font-bold text-xl md:text-2xl text-white">Welcome to {{ config('app.name') }}</span>
    </div>
    <label class="inline-flex ms-auto items-center cursor-pointer" x-data="{ darkMode: localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches) }" x-cloak x-init="document.body.classList.toggle('dark', darkMode);
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
    <a wire:navigate href="" title="User Messages" class="flex justify-center items-center p-3 hover:bg-secondary-700 dark:hover:bg-gray-700 hover:transition-colors hover:duration-500 relative rounded-full">
        <span class="material-symbols-outlined">mail</span>
        <span class="absolute top-1 right-1 size-4 rounded-full bg-primary-500 text-white dark:bg-secondary-500 text-[11px] flex justify-center items-center">45</span>
    </a>
</header>

