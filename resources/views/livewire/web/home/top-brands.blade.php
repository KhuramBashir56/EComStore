<section class="2xl:container mx-auto">
    <div class="flex flex-col gap-4">
        <div class="flex flex-col gap-2">
            <x-web.heading :title="__('Top Brands')" class="text-2xl dark:text-gray-200 border-secondary-500">
                <div class="pb-2">
                    <x-ui.buttons.button :button="__('default')" wire:click="viewAllBands" class="w-full" :title="__('View All Brands')" />
                </div>
            </x-web.heading>
            <p class="text-gray-500 dark:text-gray-400">Check out and explore our top brands, get quality products and services.</p>
        </div>
        <div class="grid lg:grid-cols-4 md:grid-cols-3 xs:grid-cols-2 gap-4">
            @foreach ($brands as $brand)
                <livewire:web.components.brand-horizontal-card wire:key="brand-{{ $brand->id }}" lazy :brand="$brand" />
            @endforeach
        </div>
    </div>
</section>
