<article class="w-full bg-white dark:bg-gray-800 rounded-md shadow-md group">
    <div class="w-full relative overflow-hidden">
        <x-thumbnail :alt="$product->name . ' Thumbnail'" :path="$product->thumbnail ? asset(config('filesystems.storage') . $product->thumbnail) : asset('assets/images/card-image.svg')" class="w-full aspect-square rounded-t-md" />
        <div class="p-2 absolute right-0 top-2 flex flex-col gap-2 rounded-l-md group-hover:shadow-lg overflow-hidden bg-white translate-x-14 group-hover:translate-x-0 transition-transform duration-300">
            <x-ui.links.icon-link :link="__('default')" wire:navigate :icon="__('visibility')" :title="__('View Product')" class="font-medium rounded-md translate-x-full group-hover:translate-x-0 transition-transform duration-300" />
            <x-ui.buttons.icon-button type="button" :button="__('default')" wire:click="addToCart('{{ $product->ref_id }}')" wire:confirm="Are you sure you want to add this product to your cart?" :icon="__('add_shopping_cart')" :title="__('Add to Cart')" class="font-medium rounded-md translate-x-full group-hover:translate-x-0 transition-transform duration-700" />
            <x-ui.buttons.icon-button type="button" :button="__('default')" wire:click="addToWishlist('{{ $product->ref_id }}')" wire:confirm="Are you sure you want to add this product to your wishlist?" :icon="__('heart_plus')" :title="__('Add to Wishlist')" class="font-medium rounded-md translate-x-full group-hover:translate-x-0 transition-transform duration-1000" />
        </div>
        <div class="flex flex-col gap-2 absolute top-2 left-0 text-xs">
            @if ($product->discount > 0)
                <span class="text-white bg-red-600 rounded-r-md py-0.5 px-2 w-fit">{{ number_format($product->discount, 2) }}% Off</span>
            @endif
            @if ($product->type == 'new')
                <span class="text-white bg-blue-500 rounded-r-md py-0.5 px-2 w-fit capitalize">{{ $product->type }}</span>
            @elseif ($product->type == 'out of stock')
                <span class="text-white bg-black rounded-r-md py-0.5 px-2 w-fit capitalize">{{ $product->type }}</span>
            @elseif ($product->type == 'special')
                <span class="text-white bg-violet-500 rounded-r-md py-0.5 px-2 w-fit capitalize">{{ $product->type }}</span>
            @elseif ($product->type == 'best selling')
                <span class="text-white bg-emerald-500 rounded-r-md py-0.5 px-2 w-fit capitalize">{{ $product->type }}</span>
            @elseif ($product->type == 'top rated')
                <span class="text-white bg-amber-500 rounded-r-md py-0.5 px-2 w-fit capitalize">{{ $product->type }}</span>
            @elseif ($product->type == 'offer')
                <span class="text-white bg-pink-500 rounded-r-md py-0.5 px-2 w-fit capitalize">{{ $product->type }}</span>
            @endif
        </div>
        <x-ui.buttons.button :button="__('default')" wire:click="buyNow({{ $product->ref_id }})" class="absolute bottom-0 left-0 z-10 -translate-x-full group-hover:translate-x-0 transition-transform duration-300 mb-2 rounded-e-md shadow-md" :title="__('Buy Now')" />
    </div>
    <div class="flex flex-col gap-1 p-3 text-gray-900 dark:text-gray-200">
        <h3 class="capitalize font-medium truncate">{{ $product->name }}</h3>
        <p class="text-xs font-bold">
            <span>Rs={{ number_format($product->price - ($product->price * $product->discount) / 100) }}/-</span>
            @if ($product->discount > 0)
                <s class="text-red-600 dark:text-red-400 ms-2 line-through decoration-2">{{ $product->price }}</s>
            @endif
        </p>
        <x-ui.inline-rating :value="$product->ratings" />
    </div>
</article>
