<aside id="mainMenu" class="sm:max-w-xs max-w-sm w-full h-full xl:static absolute top-0 left-0 xl:translate-x-0 -translate-x-full transition-transform duration-500 bg-secondary-500 dark:bg-gray-800">
    <nav class="mainMenu flex flex-col h-full overflow-y-auto divide-y divide-secondary-100 dark:divide-gray-600">
        <div x-data="{ userMenu: false }" class="p-3 flex items-center cursor-pointer gap-4 bg-primary-500 dark:bg-secondary-500 relative">
            <button type="button" onclick="menuRToggle()" class="sidebarToggle absolute xl:hidden flex justify-center items-center top-1.5 right-1.5 text-white hover:bg-secondary-700 dark:hover:bg-gray-700 transition-colors duration-500"title="Close Menu">
                <span class="material-symbols-outlined">close</span>
            </button>
            <div class="relative size-16 shrink-0 border-2 border-white rounded-full">
                <img src='{{ Auth::user()->profile_image ? asset(config('filesystems.storage' . Auth::user()->profile->image)) : asset('assets/images/panel/user.png') }}' alt="{{ Auth::user()->name . __('\'s profile picture') }}" loading="lazy" class="p-1 size-full rounded-full" />
                <span class="h-4 aspect-square rounded-full bg-green-600 block absolute bottom-0 right-0 border-2 border-primary-500 dark:border-secondary-500"></span>
            </div>
            <div class="w-full">
                <p class="text-xs text-white">Hello!</p>
                <h6 class="text-base text-white">{{ Auth::user()->name }}</h6>
                <p class="text-xs dark:text-secondary-50 text-gray-300">{{ Auth()->user()->email }}</p>
            </div>
            <button type="button" x-on:click="userMenu = !userMenu" x-on:click.away="userMenu = false" class="absolute flex justify-center items-center bottom-1.5 right-1.5 text-white hover:bg-primary-700 dark:hover:bg-secondary-700 transition-colors duration-500" title="More Options">
                <span class="material-symbols-outlined">keyboard_arrow_down</span>
            </button>
            <div x-show="userMenu" x-collapse class="z-10 absolute top-full right-1.5 w-full max-w-56 bg-white rounded-lg dark:bg-gray-700" style="display: none;">
                <div class="py-2 text-sm text-gray-700 dark:text-gray-200 divide-y divide-gray-400 dark:divide-gray-500">
                    <a wire:navigate href="" class="flex items-center gap-4 px-3 py-1.5 w-full hover:bg-gray-200 dark:hover:bg-gray-500 dark:hover:text-white">
                        <span class="material-symbols-outlined">account_circle</span>
                        <span>My Profile</span>
                    </a>
                    <a wire:navigate href="" class="flex items-center gap-4 px-3 py-1.5 w-full hover:bg-gray-200 dark:hover:bg-gray-500 dark:hover:text-white">
                        <span class="material-symbols-outlined">manage_accounts</span>
                        <span>Profile Settings</span>
                    </a>
                    <button type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center w-full gap-4 px-3 py-1.5 hover:bg-gray-200 dark:hover:bg-gray-500 dark:hover:text-white">
                        <span class="material-symbols-outlined">power_settings_new</span>
                        <a href="#" class="block">Logout</a>
                    </button>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
        @can('admin')
            <x-panel.menu-bar.admin />
        @endcan
    </nav>
    <span class="block tex-[8px] px-1.5 border-t-2 border-primary-500 dark:border-secondary-500 text-white dark:text-gray-200 bg-secondary-500 dark:bg-gray-800">&copy; 2023-{{ now()->format('y') }} All rights reserved. <span class="text-primary-500 dark:text-secondary-500">V:1.0</span></span>
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
