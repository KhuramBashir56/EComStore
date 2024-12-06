<x-slot:title>{{ __('Brand Details') }}</x-slot>
<section class="grid gap-4">
    <x-panel.navigation>
        <div class="flex flex-col 2xs:flex-row  gap-4 w-full sm:max-w-xs">
            <x-ui.links.link :link="__('default')" wire:navigate href="{{ route('admin.products.brands.list') }}" :title="__('View Brands List')" class="font-medium whitespace-nowrap rounded-md" />
            <x-ui.links.link :link="__('default')" wire:navigate href="{{ route('admin.products.brands.add') }}" :title="__('Add New Brand')" class="font-medium whitespace-nowrap rounded-md" />
        </div>
    </x-panel.navigation>
    <div class="w-full grid sm:grid-cols-2">
        <div class="sm:col-span-2 relative">
            <x-ui.links.icon-link :link="__('default')" href="{{ asset(config('filesystems.storage') . $brand->logo) }}" target="_blank" :icon="__('open_in_new')" :title="__('Open Image in New Tab')" class="font-medium rounded-md absolute top-4 left-4" />
            <x-thumbnail :alt="$brand->name . __('Brand Logo')" :path="$brand->logo ? asset(config('filesystems.storage') . $brand->logo) : asset('assets/images/card-image.svg')" class="w-full sm:max-w-56 aspect-square" />
        </div>
        <div class="flex flex-wrap gap-4 mt-4 mb-2 sm:col-span-2">
            <x-ui.links.link :link="__('default')" wire:navigate href="{{ route('admin.products.brands.add_categories', ['brand' => $brand->ref_id]) }}" :title="__('Add Category')" class="rounded-md" />
            @if ($brand->status === 'published')
                <x-ui.buttons.button type="button" :button="__('red')" wire:click="unPublishBrand" wire:confirm="Are you sure you want to unpublish this brand?" :title="__('Un Publish')" class="rounded-md" />
            @else
                <x-ui.buttons.button type="button" :button="__('green')" wire:click="publishBrand" wire:confirm="Are you sure you want to publish this brand?" :title="__('Publish')" class="rounded-md" />
            @endif
            <x-ui.links.link :link="__('blue')" wire:navigate href="{{ route('admin.products.brands.edit', ['brand' => $brand->ref_id]) }}" :title="__('Edit')" class="rounded-md" />
            <x-ui.buttons.button type="button" :button="__('red')" wire:click="deleteBrand" wire:confirm="Are you sure you want to delete this brand?" :title="__('Delete')" class="rounded-md" />
        </div>
        <x-ui.inline-heading :title="__('Name')" :content="$brand->name" class="sm:col-span-2" />
        <x-ui.inline-heading :title="__('Status')" class="uppercase">
            @if ($brand->status === 'published')
                <x-ui.badge :badge="__('green')" :content="$brand->status" class="uppercase" />
            @else
                <x-ui.badge :badge="__('red')" :content="$brand->status" class="uppercase" />
            @endif
        </x-ui.inline-heading>
        <x-ui.inline-heading :title="__('Update At')" :content="$brand->updated_at->format('d M Y h:i:s A')" />
        <x-ui.inline-heading :title="__('Keywords')" class="sm:col-span-2 gap-3">
            @php
                $keywords = explode(',', $brand->keywords);
            @endphp
            @foreach ($keywords as $keyword)
                <x-ui.badge :badge="__('default')" :content="$keyword" class="uppercase" />
            @endforeach
        </x-ui.inline-heading>
        <x-ui.inline-heading :title="__('Description')" :content="$brand->description" class="sm:col-span-2" />
        <x-ui.table class="w-full sm:col-span-2 mt-3">
            <x-ui.table.head>
                <x-ui.table.th :content="__('ID')" />
                <x-ui.table.th :content="__('Sub Category Name')" />
                <x-ui.table.th :content="__('Category Name')" />
                <x-ui.table.th :content="__('Action')" class="text=center" />
            </x-ui.table.head>
            <x-ui.table.body>
                @forelse ($brand->categories as $index => $category)
                    <x-ui.table.tr wire:key="sub-category-{{ $category->id }}">
                        <x-ui.table.td :content="$index + 1" />
                        <x-ui.table.td :content="$category->name" />
                        <x-ui.table.td :content="$category->category->name" />
                        <x-ui.table.td>
                            <x-ui.buttons.button :button="__('red')" :title="__('Remove')" wire:click="removeCategory({{ $category->id }})" wire:confirm="Are you sure you want to remove this category?" class="rounded-md" />
                        </x-ui.table.td>
                    </x-ui.table.tr>
                @empty
                    <x-ui.table.tr>
                        <x-ui.table.td colspan="4" :content="__('Categories Not Found...')" class="text-center text-xl" />
                    </x-ui.table.tr>
                @endforelse
            </x-ui.table.body>
        </x-ui.table>
    </div>
</section>
