<aside id="mainMenu" class="sm:max-w-xs max-w-sm w-full h-full xl:static absolute top-0 left-0 xl:translate-x-0 -translate-x-full transition-transform duration-500 bg-secondary-500 dark:bg-gray-900">
    <nav class="mainMenu flex flex-col h-full overflow-y-auto divide-y divide-secondary-100 dark:divide-gray-600">
        <div x-data="{ userMenu: false }" class="p-3 flex items-center cursor-pointer gap-4 bg-primary-500 dark:bg-secondary-500 relative">
            <button type="button" onclick="menuRToggle()" class="sidebarToggle absolute xl:hidden flex justify-center items-center top-1.5 right-1.5 text-white hover:bg-secondary-700 dark:hover:bg-gray-700 transition-colors duration-500"title="Close Menu">
                <span class="material-symbols-outlined">close</span>
            </button>
            <div class="relative">
                <img src='https://readymadeui.com/profile_2.webp' class="w-16 aspect-square p-1 rounded-full border-2 border-gray-300" />
                <span class="h-4 aspect-square rounded-full bg-green-600 block absolute bottom-0 right-0 border-2 border-primary-500 dark:border-secondary-500"></span>
            </div>
            <div class="w-full">
                <p class="text-xs text-white">Hello</p>
                <h6 class="text-base text-white">{{ Auth::user()->name }}</h6>
                <p class="text-xs text-gray-300">{{ Auth()->user()->email }}</p>
            </div>
            <button type="button" x-on:click="userMenu = !userMenu" x-on:click.away="userMenu = false" class="absolute flex justify-center items-center bottom-1.5 right-1.5 text-white hover:bg-primary-700 dark:hover:bg-secondary-700 transition-colors duration-500" title="More Options">
                <span class="material-symbols-outlined">keyboard_arrow_down</span>
            </button>
            <div x-show="userMenu" x-collapse class="z-10 absolute top-full right-1.5 w-full max-w-56 bg-white divide-y divide-gray-100 rounded-lg dark:bg-gray-700 dark:divide-gray-600" style="display: none;">
                <div class="py-2 text-sm text-gray-700 dark:text-gray-200">
                    <a wire:navigate href="" class="flex items-center gap-4 px-3 py-1.5 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        <span class="material-symbols-outlined">account_circle</span>
                        <span>My Profile</span>
                    </a>
                    <a wire:navigate href="" class="flex items-center gap-4 px-3 py-1.5 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        <span class="material-symbols-outlined">manage_accounts</span>
                        <span>Profile Settings</span>
                    </a>
                </div>
                <div class="py-2 text-gray-700 dark:text-gray-200">
                    <button type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center w-full gap-4 px-3 py-1.5 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        <span class="material-symbols-outlined">power_settings_new</span>
                        <a href="#" class="block">Logout</a>
                    </button>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
        <x-panel.menu-bar.menu-item href="{{ route('admin.dashboard') }}" :title="__('Dashboard')" :icon="__('dashboard')" :active="__('admin.dashboard')" />
        @can('admin')
            <x-panel.menu-bar.admin />
        @endcan
    </nav>
    <span class="block tex-[10px] px-1.5 border-t-2 border-primary-500 dark:border-secondary-500 text-white dark:text-gray-200 bg-secondary-500 dark:bg-gray-800">&copy; 2023 - {{ now()->format('y') }} All rights reserved. v:1.0</span>
</aside>
@push('scripts')
    <script type="text/javascript">
        var mainMenu = document.getElementById('mainMenu');
        var sidebarToggles = document.querySelectorAll('.sidebarToggle');

        function menuRToggle() {
            mainMenu.classList.toggle('-translate-x-full');
        }

        document.addEventListener('click', function(event) {
            let clickedInsideToggle = Array.from(sidebarToggles).some(function(toggle) {
                return toggle.contains(event.target);
            });
            if (!mainMenu.contains(event.target) && !clickedInsideToggle) {
                mainMenu.classList.add('-translate-x-full');
            }
        });

        window.addEventListener('resize', function(event) {
            mainMenu.classList.add('-translate-x-full');
        });
    </script>
@endpush
