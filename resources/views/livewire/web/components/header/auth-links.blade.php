<div>
    @auth
        <a href="{{ route('dashboard') }}" class="inline-block px-3 py-1 hover:bg-secondary-700 dark:hover:bg-gray-700 hover:transition-colors hover:duration-500">Dashboard</a>
    @else
        <a wire:navigate href="{{ route('login') }}" class="inline-block px-3 py-1 hover:bg-secondary-700 dark:hover:bg-gray-700 hover:transition-colors hover:duration-500">Login</a>
        <a wire:navigate href="{{ route('register') }}" class="inline-block px-3 py-1 hover:bg-secondary-700 dark:hover:bg-gray-700 hover:transition-colors hover:duration-500">Register</a>
    @endauth
</div>
