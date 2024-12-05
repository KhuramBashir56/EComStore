<div class="w-full divide-y divide-primary-200 dark:divide-gray-600">
    @guest
        <a wire:navigate href="{{ route('login') }}" class="flex items-center px-3 py-2 hover:bg-secondary-500 dark:hover:bg-gray-700 hover:transition-colors hover:duration-500">Login</a>
        <a wire:navigate href="{{ route('register') }}" class="flex items-center px-3 py-2 hover:bg-secondary-500 dark:hover:bg-gray-700 hover:transition-colors hover:duration-500">Register</a>
    @endguest
</div>
