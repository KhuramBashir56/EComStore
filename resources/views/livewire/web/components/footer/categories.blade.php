<div class="w-full divide-y divide-primary-200 dark:divide-gray-600">
    @foreach ($categories as $category)
        <a wire:navigate href="{{ route('home') }}" class="flex items-center justify-between px-3 py-2 hover:bg-secondary-500 dark:hover:bg-gray-700 transition-colors duration-500">
            <span>{{ $category->name }}</span>
            <span class="flex justify-center items-center font-medium bg-white dark:bg-gray-500 text-xs rounded-full size-6 text-primary-500 dark:text-white">45</span>
        </a>
    @endforeach
</div>
