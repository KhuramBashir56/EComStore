<x-slot:title>{{ __('Brands') }}</x-slot>
<section class="grid gap-4">
    <x-panel.navigation>
        <div class="flex gap-4 w-full sm:max-w-xs">
            <x-ui.links.link :link="__('default')" wire:navigate href="{{ route('admin.products.brands.add') }}" :title="__('Add New Brand')" class="font-medium whitespace-nowrap rounded-md" />
            <x-ui.form.select :for="__('range')" :title="__('Records Range')" wire:model.live="range" class="w-full sm:max-w-xs">
                <x-ui.form.option :content="__('25')" value="25" />
                <x-ui.form.option :content="__('50')" value="50" />
                <x-ui.form.option :content="__('100')" value="100" />
                <x-ui.form.option :content="__('250')" value="250" />
                <x-ui.form.option :content="__('500')" value="500" />
            </x-ui.form.select>
        </div>
        <x-ui.form.input type="search" wire:model.live.debounce.500ms="search" :for="__('search')" placeholder="{{ __('Search unit...') }}" class="sm:max-w-xs" />
    </x-panel.navigation>
    <x-ui.table>
        <x-ui.table.head>
            <x-ui.table.th :content="__('logo')" />
            <x-ui.table.th :content="__('brand Name')" />
            <x-ui.table.th :content="__('Status')" />
            <x-ui.table.th :content="__('Action')" class="text-center" />
        </x-ui.table.head>
        <x-ui.table.body>
            @forelse($brands as $brand)
                <x-ui.table.tr wire:key="brand-{{ $brand->id }}">
                    <x-ui.table.td>
                        <x-thumbnail :url="asset(config('filesystems.storage') . $brand->logo)" class="w-24 aspect-square" />
                    </x-ui.table.td>
                    <x-ui.table.td :content="$brand->name" />
                    <x-ui.table.td class="text-center">
                        @if ($brand->status === 'published')
                            <x-ui.badge :badge="__('green')" :content="$brand->status" class="uppercase" />
                        @else
                            <x-ui.badge :badge="__('red')" :content="$brand->status" class="uppercase" />
                        @endif
                    </x-ui.table.td>
                    <x-ui.table.td class="text-center">
                        <x-ui.table.actions>
                            @if ($brand->status === 'published')
                                <x-ui.buttons.transparent-icon-button type="button" :button="__('red')" wire:click="unPublishBrand({{ $brand->id }})" wire:confirm="Are you sure you want to unpublish this brand?" :title="__('Un Publish')" :icon="__('visibility_off')" class="rounded-md" />
                            @else
                                <x-ui.buttons.transparent-icon-button type="button" :button="__('green')" wire:click="publishBrand({{ $brand->id }})" wire:confirm="Are you sure you want to publish this brand?" :title="__('Publish')" :icon="__('visibility')" class="rounded-md" />
                            @endif
                            <x-ui.buttons.transparent-icon-button type="button" :button="__('default')" wire:click="viewBrand({{ $brand->id }})" :title="__('View Details')" :icon="__('info')" class="rounded-md" />
                            <x-ui.buttons.transparent-icon-button type="button" :button="__('blue')" wire:click="editBrand({{ $brand->id }})" :title="__('Edit')" :icon="__('edit')" class="rounded-md" />
                            <x-ui.buttons.transparent-icon-button type="button" :button="__('red')" wire:click="deleteBrand({{ $brand->id }})" wire:confirm="Are you sure you want to delete this brand?" :title="__('Delete')" :icon="__('delete')" class="rounded-md" />
                        </x-ui.table.actions>
                    </x-ui.table.td>
                </x-ui.table.tr>
            @empty
                <x-ui.table.tr>
                    <x-ui.table.td colspan="4" :content="__('Brands Not Found...')" class="text-center text-xl" />
                </x-ui.table.tr>
            @endforelse
        </x-ui.table.body>
    </x-ui.table>
    {{ $brands->links('components.ui.table.pagination') }}
</section>
