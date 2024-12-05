<article class="w-full flex items-center gap-4 bg-white dark:bg-gray-800 rounded-md shadow-md group">
    <div class="w-20 aspect-square overflow-hidden">
        <x-thumbnail :alt="$brand->name . ' Thumbnail'" :path="$brand->logo ? asset(config('filesystems.storage') . $brand->logo) : asset('assets/images/card-image.svg')" class="w-full aspect-square" />
    </div>
    <div class="space-y-1">
        <h6 class="text-lg uppercase font-semibold text-gray-800 dark:text-gray-100 group-hover:text-primary-500 dark:group-hover:text-secondary-500 transition-colors duration-500 truncate">{{ $brand->name }}</h6>
        <p class="text-sm text-gray-600 dark:text-gray-400 group-hover:text-primary-500 dark:group-hover:text-secondary-500 transition-colors duration-500"><strong>{{ __('Products: ') }}</strong> {{ $brand->products->count() }}</p>
    </div>
</article>
