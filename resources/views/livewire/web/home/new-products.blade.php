<section class="2xl:container mx-auto">
    <div class="flex flex-col gap-4">
        <div class="flex flex-col gap-2">
            <x-web.heading :title="__('New Products')" class="text-2xl dark:text-gray-200 border-secondary-500">
                <x-ui.buttons.button :button="__('default')" class="w-full" :title="__('View All Products')" class="w-fit mb-2" />
            </x-web.heading>
            <div class="flex md:flex-row flex-col gap-2 md:justify-between justify-center items-center">
                <p class="text-gray-500 dark:text-gray-400">Check out our latest products and get the best deals.</p>
                <div class="flex gap-4 justify-center items-center">
                    <x-ui.buttons.icon-button type="button" :button="__('default')" :title="__('Previous')" :icon="__('chevron_left')" x-on:click="$('.new-products').trigger('prev.owl.carousel')" />
                    <x-ui.buttons.icon-button type="button" :button="__('default')" :title="__('Next')" :icon="__('chevron_right')" x-on:click="$('.new-products').trigger('next.owl.carousel')" />
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-4">
            <div class="owl-carousel new-products">
                @foreach ($products as $product)
                    <div wire:key="home-new-product-{{ $product->id }}" class="w-full">
                        <livewire:web.components.product-vertical-card lazy :key="'home-new-product-' . $product->id" :$product />
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@assets
    <link rel="stylesheet" href="{{ asset('plugins/owl.carousel.min.css') }}">
    <script type="text/javascript" src="{{ asset('plugins/jquery.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('plugins/owl.carousel.min.js') }}" defer></script>
@endassets
@script
    <script type="text/javascript">
        $(document).ready(function() {
            $('.new-products').owlCarousel({
                margin: 16,
                nav: false,
                dots: false,
                rewind: true,
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
