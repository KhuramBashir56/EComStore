<nav class="px-4 dark:bg-gray-800">
    <div class="2xl:container mx-auto">
        <div class="flex items-stretch">
            <button onclick="menuRToggle()" class="sidebarToggle lg:hidden sm:flex hidden justify-center items-center p-3 me-2 hover:bg-secondary-700 dark:hover:bg-gray-700 transition-colors duration-500" title="Toggle Menu">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <livewire:web.components.header.categories />
            <div class="fixed bottom-0 left-0 w-full sm:hidden flex items-center justify-between bg-secondary-500 dark:bg-gray-800 px-4 border-t border-secondary-100 dark:border-gray-700">
                <button onclick="menuRToggle()" class="sidebarToggle flex justify-center items-center px-3 py-2 hover:bg-secondary-700 dark:hover:bg-gray-700 transition-colors duration-500" title="Toggle Menu">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <button class="flex justify-center items-center px-3 py-2 hover:bg-secondary-700 dark:hover:bg-gray-700 transition-colors duration-500" title="Search">
                    <span class="material-symbols-outlined">search</span>
                </button>
                <a wire:navigate href="{{ route('home') }}" class="flex justify-center items-center px-3 py-2 hover:bg-secondary-700 dark:hover:bg-gray-700 transition-colors duration-500" title="Home">
                    <span class="material-symbols-outlined">home</span>
                </a>
                <button title="My Cart" class="flex justify-center items-center px-3 py-2 hover:bg-secondary-700 dark:hover:bg-gray-700 transition-colors duration-500 relative">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    <span class="absolute top-1 right-1 size-4 rounded-full bg-primary-500 text-white dark:bg-secondary-500 text-[11px] flex justify-center items-center">45</span>
                </button>
                <button title="Wishlist" class="flex justify-center items-center px-3 py-2 hover:bg-secondary-700 dark:hover:bg-gray-700 transition-colors duration-500 relative">
                    <span class="material-symbols-outlined">favorite</span>
                    <span class="absolute top-1 right-1 size-4 rounded-full bg-primary-500 text-white dark:bg-secondary-500 text-[11px] flex justify-center items-center">45</span>
                </button>
            </div>
            <div id="mainMenu" class="inset-0 w-full h-full lg:max-w-full sm:max-w-xs max-w-sm lg:static fixed top-0 left-0 lg:translate-x-0 -translate-x-full transition-transform duration-500 bg-secondary-500 dark:bg-gray-800">
                <div class="lg:hidden flex items-center justify-center py-3 bg-primary-500 dark:bg-secondary-500">
                    <span>Main Menu</span>
                    <button type="button" onclick="menuRToggle()" class="sidebarToggle absolute flex justify-center items-center top-3 right-3 hover:bg-secondary-700 dark:hover:bg-gray-700 transition-colors duration-500" title="Close Menu"><span class="material-symbols-outlined">close</span></button>
                </div>
                <div class="h-full flex lg:flex-row flex-col overflow-y-auto lg:divide-none divide-y divide-secondary-100 dark:divide-gray-700 lg:pb-0 pb-12">
                    <a wire:navigate href="{{ route('home') }}" class="flex items-center px-3 py-1.5 hover:bg-secondary-700 dark:hover:bg-gray-700 transition-colors duration-500 {{ request()->routeIs('home') ? 'bg-secondary-700 dark:bg-gray-700' : '' }}">Home</a>
                    <a wire:navigate href="" class="flex items-center px-3 py-1.5 hover:bg-secondary-700 dark:hover:bg-gray-700 transition-colors duration-500">Products</a>
                    <a wire:navigate href="" class="flex items-center px-3 py-1.5 hover:bg-secondary-700 dark:hover:bg-gray-700 transition-colors duration-500">Track Order</a>
                    <a wire:navigate href="" class="flex items-center px-3 py-1.5 hover:bg-secondary-700 dark:hover:bg-gray-700 transition-colors duration-500">About Us</a>
                    <a wire:navigate href="" class="flex items-center px-3 py-1.5 hover:bg-secondary-700 dark:hover:bg-gray-700 transition-colors duration-500">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</nav>
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
