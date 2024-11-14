<x-slot:title>{{ __('Category Details') }}</x-slot>
<section class="grid gap-4">
    <x-panel.navigation>
        <div class="flex gap-4 w-full sm:max-w-xs">
            <x-ui.links.link :link="__('default')" wire:navigate href="{{ route('admin.products.sub_categories.list') }}" :title="__('View Sub Categories')" class="font-medium whitespace-nowrap rounded-md" />
            <x-ui.links.link :link="__('default')" wire:navigate href="{{ route('admin.products.sub_categories.add') }}" :title="__('Add New Sub Category')" class="font-medium whitespace-nowrap rounded-md" />
        </div>
    </x-panel.navigation>
    <div class="w-full grid sm:grid-cols-2">
        <div class="sm:col-span-2 relative">
            <x-ui.links.icon-link :link="__('default')" href="{{ asset(config('filesystems.storage') . $category->thumbnail) }}" target="_blank" :icon="__('open_in_new')" :title="__('Open Image in New Tab')" class="font-medium rounded-md absolute top-4 left-4" />
            <x-thumbnail :url="asset(config('filesystems.storage') . $category->thumbnail)" class="w-full sm:max-w-56 aspect-square" />
        </div>
        <div class="flex flex-wrap gap-4 mt-4 mb-2 sm:col-span-2">
            <x-ui.links.link :link="__('default')" wire:navigate href="{{ route('admin.products.sub_categories.add_brands', ['category' => $category->ref_id]) }}" :title="__('Add Brands')" class="rounded-md" />
            @if ($category->status === 'published')
                <x-ui.buttons.button type="button" :button="__('red')" wire:click="unPublishSubCategory" wire:confirm="Are you sure you want to unpublish this category?" :title="__('Un Publish')" class="rounded-md" />
            @else
                <x-ui.buttons.button type="button" :button="__('green')" wire:click="publishSubCategory" wire:confirm="Are you sure you want to publish this category?" :title="__('Publish')" class="rounded-md" />
            @endif
            <x-ui.links.link :link="__('blue')" wire:navigate href="{{ route('admin.products.sub_categories.edit', ['category' => $category->ref_id]) }}" :title="__('Edit')" class="rounded-md" />
            <x-ui.buttons.button type="button" :button="__('red')" wire:click="deleteSubCategory" wire:confirm="Are you sure you want to delete this sub category?" :title="__('Delete')" class="rounded-md" />
        </div>
        <x-ui.inline-heading :title="__('Sub Category Name')" :content="$category->name" class="sm:col-span-2" />
        <x-ui.inline-heading :title="__('Category Name')" :content="$category->category->name" class="sm:col-span-2" />
        <x-ui.inline-heading :title="__('Status')" class="uppercase">
            @if ($category->status === 'published')
                <x-ui.badge :badge="__('green')" :content="$category->status" class="uppercase" />
            @else
                <x-ui.badge :badge="__('red')" :content="$category->status" class="uppercase" />
            @endif
        </x-ui.inline-heading>
        <x-ui.inline-heading :title="__('Last Update At')" :content="$category->updated_at->format('d M Y h:i:s A')" />
        <x-ui.inline-heading :title="__('Keywords')" class="sm:col-span-2 gap-3">
            @php
                $keywords = explode(',', $category->keywords);
            @endphp
            @foreach ($keywords as $keyword)
                <x-ui.badge :badge="__('default')" :content="$keyword" class="uppercase" />
            @endforeach
        </x-ui.inline-heading>
        <x-ui.inline-heading :title="__('Description')" :content="$category->description" class="sm:col-span-2" />
        <x-ui.table class="w-full sm:col-span-2 mt-3">
            <x-ui.table.head>
                <x-ui.table.th :content="__('ID')" />
                <x-ui.table.th :content="__('Brand Name')" />
                <x-ui.table.th :content="__('Action')" class="text=center" />
            </x-ui.table.head>
            <x-ui.table.body>
                @forelse ($category->brands as $index => $brand)
                    <x-ui.table.tr wire:key="sub-category-{{ $brand->id }}">
                        <x-ui.table.td :content="$index + 1" />
                        <x-ui.table.td :content="$brand->name" />
                        <x-ui.table.td>
                            <x-ui.buttons.button :button="__('red')" :title="__('Remove')" wire:click="removeBrand({{ $brand->id }})" wire:confirm="Are you sure you want to remove this brand?" class="rounded-md" />
                        </x-ui.table.td>
                    </x-ui.table.tr>
                @empty
                    <x-ui.table.tr>
                        <x-ui.table.td colspan="3" :content="__('Categories Not Found...')" class="text-center text-xl" />
                    </x-ui.table.tr>
                @endforelse
            </x-ui.table.body>
        </x-ui.table>
    </div>
</section>
