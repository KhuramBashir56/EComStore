<article class="w-full">
    <a wire:navigate href="{{ route('home') }}" class="w-full flex items-center gap-4 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 hover:text-primary-500 dark:hover:text-secondary-500 hover:transition-colors hover:duration-500 shadow-md">
        <x-thumbnail :alt="$brand->name . ' Thumbnail'" :path="$brand->logo ? asset(config('filesystems.storage') . $brand->logo) : asset('assets/images/card-image.svg')" class="w-20 aspect-square" />
        <div class="flex flex-col gap-1">
            <h3 class="uppercase font-medium truncate">{{ Str::limit($brand->name, 12, '...') }}</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400"> {{ __('Products: ') }} <strong> {{ $brand->products->count() }} </strong></p>
        </div>
    </a>
</article>
