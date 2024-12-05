<section class="2xl:container mx-auto">
    <div class="flex flex-col gap-4">
        <div class="flex flex-col gap-2">
            <x-web.heading :title="__('New Products')" class="text-2xl dark:text-gray-200 border-secondary-500">
                <x-ui.buttons.button :button="__('default')" wire:click="viewAllNewProducts" class="w-full" :title="__('View All Products')" class="w-fit mb-2" />
            </x-web.heading>
            <div class="flex md:flex-row flex-col gap-2 md:justify-between justify-center items-center">
                <p class="text-gray-500 dark:text-gray-400">Check out our latest products and get the best deals.</p>
                <div class="flex gap-4 justify-center items-center">
                    <x-ui.buttons.icon-button type="button" :button="__('default')" :title="__('Previous')" :icon="__('chevron_left')" onclick="$('.new-products').trigger('prev.owl.carousel')" />
                    <x-ui.buttons.icon-button type="button" :button="__('default')" :title="__('Next')" :icon="__('chevron_right')" onclick="$('.new-products').trigger('next.owl.carousel')" />
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-4">
            <div class="owl-carousel new-products">
                @foreach ($products as $product)
                    <livewire:web.components.product-vertical-card wire:key="product-{{ $product->id }}" lazy :product="$product" />
                @endforeach
            </div>
        </div>
    </div>
</section>
@assets
    <link rel="stylesheet" href="{{ asset('plugins/owl.carousel.min.css') }}">
    <script src="{{ asset('plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/owl.carousel.min.js') }}"></script>
@endassets
@script
    <script>
        $(document).ready(function() {
            $('.new-products').owlCarousel({
                margin: 10,
                nav: false,
                dots: false,
                rewind: true,
                margin: 18,
                autoplay: true,
                autoplaySpeed: 2000,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 1,
                    },
                    320: {
                        items: 2,
                    },
                    480: {
                        items: 3,
                    },
                    640: {
                        items: 4,
                    },
                    1024: {
                        items: 5,
                    },
                    1280: {
                        items: 6,
                    },
                    1536: {
                        items: 7,
                    },
                },
            });
        });
    </script>
@endscript
