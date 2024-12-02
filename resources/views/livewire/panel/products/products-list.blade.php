<x-slot:title>{{ __('Products') }}</x-slot>
<section class="grid gap-4">
    <x-panel.navigation>
        <div class="flex gap-4 w-full sm:max-w-xs">
            <x-ui.links.link :link="__('default')" wire:navigate href="{{ route('admin.products.add_product.overview') }}" :title="__('Add New Product')" class="font-medium whitespace-nowrap rounded-md" />
            <x-ui.form.select :for="__('range')" :title="__('Records Range')" wire:model.live="range" class="2xs:max-w-20 w-full">
                <x-ui.form.option :content="__('25')" value="25" />
                <x-ui.form.option :content="__('50')" value="50" />
                <x-ui.form.option :content="__('100')" value="100" />
                <x-ui.form.option :content="__('250')" value="250" />
                <x-ui.form.option :content="__('500')" value="500" />
            </x-ui.form.select>
        </div>
        <x-ui.form.input type="search" wire:model.live.debounce.500ms="search" :for="__('search')" placeholder="{{ __('Search product...') }}" class="sm:max-w-xs" />
    </x-panel.navigation>
    <x-ui.table>
        <x-ui.table.head>
            <x-ui.table.th :content="__('thumbnail')" />
            <x-ui.table.th :content="__('Product Name')" />
            <x-ui.table.th :content="__('Stock')" />
            <x-ui.table.th :content="__('Status')" />
            <x-ui.table.th :content="__('Action')" class="text-center" />
        </x-ui.table.head>
        <x-ui.table.body>
            @forelse($products as $product)
                <x-ui.table.tr wire:key="product-{{ $product->id }}">
                    <x-ui.table.td>
                        <x-thumbnail :url="$product->thumbnail ? asset(config('filesystems.storage') . $product->thumbnail) : asset('assets/images/card-image.svg')" class="w-24 aspect-square" />
                    </x-ui.table.td>
                    <x-ui.table.td :content="$product->name" />
                    <x-ui.table.td :content="$product->stock" />
                    <x-ui.table.td class="text-center">
                        @if ($product->status === 'published')
                            <x-ui.badge :badge="__('green')" :content="$product->status" class="uppercase" />
                        @else
                            <x-ui.badge :badge="__('red')" :content="$product->status" class="uppercase" />
                        @endif
                    </x-ui.table.td>
                    <x-ui.table.td class="text-center">
                        <x-ui.table.actions>
                            @if ($product->status === 'published')
                                <x-ui.buttons.transparent-icon-button type="button" :button="__('red')" wire:click="unPublishProduct({{ $product->id }})" wire:confirm="Are you sure you want to unpublish this Product?" :title="__('Un Publish')" :icon="__('visibility_off')" class="rounded-md" />
                            @else
                                <x-ui.buttons.transparent-icon-button type="button" :button="__('green')" wire:click="publishProduct({{ $product->id }})" wire:confirm="Are you sure you want to publish this Product?" :title="__('Publish')" :icon="__('visibility')" class="rounded-md" />
                            @endif
                            <x-ui.buttons.transparent-icon-button type="button" :button="__('default')" wire:click="viewProduct({{ $product->id }})" :title="__('View Details')" :icon="__('info')" class="rounded-md" />
                            <x-ui.buttons.transparent-icon-button type="button" :button="__('blue')" wire:click="editProduct({{ $product->id }})" :title="__('Edit')" :icon="__('edit')" class="rounded-md" />
                            <x-ui.buttons.transparent-icon-button type="button" :button="__('red')" wire:click="deleteProduct({{ $product->id }})" wire:confirm="Are you sure you want to delete this Product?" :title="__('Delete')" :icon="__('delete')" class="rounded-md" />
                        </x-ui.table.actions>
                    </x-ui.table.td>
                </x-ui.table.tr>
            @empty
                <x-ui.table.tr>
                    <x-ui.table.td colspan="4" :content="__('Categories Not Found...')" class="text-center text-xl" />
                </x-ui.table.tr>
            @endforelse
        </x-ui.table.body>
    </x-ui.table>
    {{ $products->links('components.ui.table.pagination') }}
</section>
