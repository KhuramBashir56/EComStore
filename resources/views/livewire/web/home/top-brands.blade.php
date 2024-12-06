<section class="2xl:container mx-auto">
    <div class="flex flex-col gap-4">
        <div class="flex flex-col gap-2">
            <x-web.heading :title="__('Top Brands')" class="text-2xl dark:text-gray-200 border-secondary-500">
                <x-ui.buttons.button :button="__('default')" class="w-full" :title="__('View All Brands')" class="ms-auto mb-2" />
            </x-web.heading>
            <p class="text-gray-500 dark:text-gray-400">Check out and explore our top brands, get quality products and services.</p>
        </div>
        <div class="grid lg:grid-cols-4 md:grid-cols-3 xs:grid-cols-2 gap-4">
            @foreach ($brands as $brand)
                <div wire:key ="home-top-brand-{{ $brand->id }}" class="w-full">
                    <livewire:web.components.brand-horizontal-card lazy :key="'home-top-brand-' . $brand->id" :$brand />
                </div>
            @endforeach
        </div>
    </div>
</section>
