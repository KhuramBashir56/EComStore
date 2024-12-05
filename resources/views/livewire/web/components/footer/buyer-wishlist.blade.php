<button title="Wishlist" class="flex justify-center items-center px-3 py-2 hover:bg-secondary-700 dark:hover:bg-gray-700 hover:transition-colors hover:duration-500 relative">
    <span class="material-symbols-outlined">favorite</span>
    @auth
        <span class="absolute top-1 right-1 size-4 rounded-full bg-primary-500 text-white dark:bg-secondary-500 text-[11px] flex justify-center items-center">{{ $wishlistCount }}</span>
    @endauth
</button>
