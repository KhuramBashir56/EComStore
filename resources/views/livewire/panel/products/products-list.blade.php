<x-slot:title>{{ __('Products') }}</x-slot>
<section class="grid gap-4">
    <x-panel.navigation>
        <div class="flex gap-4 w-full sm:max-w-xs">
            <x-ui.links.link :link="__('default')" wire:navigate href="{{ route('admin.products.add_product.overview') }}" :title="__('Add New Product')" class="font-medium whitespace-nowrap rounded-md" />
            <x-ui.form.select :for="__('range')" :title="__('Records Range')" wire:model.live="range" class="w-full sm:max-w-xs">
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
            <x-ui.table.th :content="__('Status')" />
            <x-ui.table.th :content="__('Action')" class="text-center" />
        </x-ui.table.head>
        <x-ui.table.body>
            {{-- @forelse($categories as $category)
                <x-ui.table.tr wire:key="category-{{ $category->id }}">
                    <x-ui.table.td>
                        <x-thumbnail :url="asset(config('filesystems.storage') . $category->thumbnail)" class="w-24 aspect-square" />
                    </x-ui.table.td>
                    <x-ui.table.td :content="$category->name" />
                    <x-ui.table.td class="text-center">
                        @if ($category->status === 'published')
                            <x-ui.badge :badge="__('green')" :content="$category->status" class="uppercase" />
                        @else
                            <x-ui.badge :badge="__('red')" :content="$category->status" class="uppercase" />
                        @endif
                    </x-ui.table.td>
                    <x-ui.table.td class="text-center">
                        <x-ui.table.actions>
                            @if ($category->status === 'published')
                                <x-ui.buttons.transparent-icon-button type="button" :button="__('red')" wire:click="unPublishCategory({{ $category->id }})" wire:confirm="Are you sure you want to unpublish this category?" :title="__('Un Publish')" :icon="__('visibility_off')" class="rounded-md" />
                            @else
                                <x-ui.buttons.transparent-icon-button type="button" :button="__('green')" wire:click="publishCategory({{ $category->id }})" wire:confirm="Are you sure you want to publish this category?" :title="__('Publish')" :icon="__('visibility')" class="rounded-md" />
                            @endif
                            <x-ui.buttons.transparent-icon-button type="button" :button="__('default')" wire:click="viewCategory({{ $category->id }})" :title="__('View Details')" :icon="__('info')" class="rounded-md" />
                            <x-ui.buttons.transparent-icon-button type="button" :button="__('blue')" wire:click="editCategory({{ $category->id }})" :title="__('Edit')" :icon="__('edit')" class="rounded-md" />
                            <x-ui.buttons.transparent-icon-button type="button" :button="__('red')" wire:click="deleteCategory({{ $category->id }})" wire:confirm="Are you sure you want to delete this category?" :title="__('Delete')" :icon="__('delete')" class="rounded-md" />
                        </x-ui.table.actions>
                    </x-ui.table.td>
                </x-ui.table.tr>
            @empty
                <x-ui.table.tr>
                    <x-ui.table.td colspan="4" :content="__('Categories Not Found...')" class="text-center text-xl" />
                </x-ui.table.tr>
            @endforelse --}}
        </x-ui.table.body>
    </x-ui.table>
    {{-- {{ $categories->links('components.ui.table.pagination') }} --}}
</section>
