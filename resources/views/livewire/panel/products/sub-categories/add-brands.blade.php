<x-slot:title>{{ __('Assign Brands to ') . $category->name }}</x-slot>
<section class="grid gap-4">
    <x-panel.navigation>
        <x-ui.links.link :link="__('default')" wire:navigate href="{{ route('admin.products.sub_categories.details', ['category' => $category->ref_id]) }}" :title="__('Go Back')" class="font-medium whitespace-nowrap rounded-md" />
        <x-ui.form.input type="search" wire:model.live.debounce.500ms="search" :for="__('search')" placeholder="{{ __('Search category...') }}" class="sm:max-w-xs" />
    </x-panel.navigation>
    <x-ui.table>
        <x-ui.table.head>
            <x-ui.table.th :content="__('Brand Name')" />
            <x-ui.table.th :content="__('Action')" class="text=center" />
        </x-ui.table.head>
        <x-ui.table.body>
            @forelse ($brands as $brand)
                <x-ui.table.tr wire:key="brand-{{ $brand->id }}">
                    <x-ui.table.td :content="$brand->name" />
                    <x-ui.table.td>
                        <x-ui.buttons.button :button="__('green')" :title="__('Add')" wire:click="addBrand({{ $brand->id }})" wire:confirm="Are you sure you want to add this category?" class="rounded-md" />
                    </x-ui.table.td>
                </x-ui.table.tr>
            @empty
                <x-ui.table.tr>
                    <x-ui.table.td colspan="3" :content="__('Brands Not Found...')" class="text-center text-xl" />
                </x-ui.table.tr>
            @endforelse
        </x-ui.table.body>
    </x-ui.table>
</section>
