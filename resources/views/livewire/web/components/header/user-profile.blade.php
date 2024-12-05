<div class="relative" x-data="{ profile: false }">
    <button @auth x-on:click="profile = !profile" @else wire:click="userProfile" wire:loading.attr="disabled" wire:offline.attr="disabled" wire:loading.class="cursor-wait" @endauth title="Wishlist" class="flex justify-center items-center p-3 hover:bg-secondary-700 dark:hover:bg-gray-700 hover:transition-colors hover:duration-500 rounded-full">
        <span class="material-symbols-outlined">account_circle</span>
    </button>
    @auth
        <div x-show="profile" x-on:click.away="profile = false" x-transition.500ms x-collapse class="min-w-64 max-w-64 absolute xs:right-0 right-[-35px] top-full shadow-lg z-50 bg-white rounded-lg" style="display: none;">
            <div class="text-center bg-primary-500 dark:bg-gray-700 text-white p-4 rounded-t-lg grid">
                <img src="{{ asset(Auth::user()->profile_image ? config('filesystems.storage') . Auth::user()->profile->image : 'assets/images/panel/user.png') }}" alt="Profile Image" loading="lazy" class="size-24 border-2 border-white rounded-full mx-auto">
                <span class="text-xl mt-4">{{ Auth::user()->name }}</span>
                <span class="text-sm opacity-65">{{ Auth::user()->email }}</span>
            </div>
            <div class="divide-y divide-gray-400 max-w-sm max-h-80 overflow-y-auto bg-secondary-500 dark:bg-gray-800">
                <a wire:navigate href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 hover:bg-secondary-600 dark:hover:bg-gray-700 hover:transition-colors hover:duration-500">Dashboard</a>
                {{-- @cannot('admin')
            <x-web.header.link href="{{ route('buyer.my_orders_history') }}" wire:navigate :title="__('Orders History')" />
                <x-web.header.link href="{{ route('buyer.my_wishlist') }}" wire:navigate :title="__('My Wishlist')" />
                <x-web.header.link href="{{ route('buyer.my_cart') }}" wire:navigate :title="__('My Cart')" />
                @endcannot --}}
                <button type="button" onclick="document.getElementById('logout').submit()" class="flex items-center px-3 py-2 text-white hover:bg-red-600 hover:text-white hover:transition-colors hover:duration-500 w-full">Logout</button>
            </div>
            <form action="{{ route('logout') }}" id="logout" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    @endauth
</div>
