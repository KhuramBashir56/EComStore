<x-slot:title>{{ __('Brand Details') }}</x-slot>
<section class="grid gap-4">
    <x-panel.navigation>
        <div class="flex gap-4 w-full sm:max-w-xs">
            <x-ui.links.link :link="__('default')" wire:navigate href="{{ route('admin.products.brands.list') }}" :title="__('View Brands List')" class="font-medium whitespace-nowrap rounded-md" />
            <x-ui.links.link :link="__('default')" wire:navigate href="{{ route('admin.products.brands.add') }}" :title="__('Add New Brand')" class="font-medium whitespace-nowrap rounded-md" />
        </div>
    </x-panel.navigation>
    <x-ui.card class="w-full rounded-xl p-4 sm:grid-cols-2">
        <x-thumbnail :url="asset(config('filesystems.storage') . $brand->logo)" class="w-full sm:max-w-56 aspect-square sm:col-span-2" />
        <x-ui.inline-heading :title="__('Name')" :content="$brand->name" class="sm:col-span-2" />
        <x-ui.inline-heading :title="__('Status')" :content="$brand->status" class="uppercase" />
        <x-ui.inline-heading :title="__('Last Update At')" :content="$brand->updated_at->format('d M Y h:i:s A')" />
        <x-ui.inline-heading :title="__('Keywords')" class="sm:col-span-2 gap-3">
            @php
                $keywords = explode(',', $brand->keywords);
            @endphp
            @foreach ($keywords as $keyword)
                <x-ui.badge :badge="__('default')" :content="$keyword" class="uppercase" />
            @endforeach
        </x-ui.inline-heading>
        <x-ui.inline-heading :title="__('Description')" :content="$brand->name" class="sm:col-span-2" />
        <div class="flex flex-wrap gap-4 mt-4 sm:col-span-2">
            @if ($brand->status === 'published')
                <x-ui.buttons.button type="button" :button="__('red')" wire:click="unpublishBrand" wire:confirm="Are you sure you want to unpublish this brand?" :title="__('Un Publish')" class="rounded-md" />
            @else
                <x-ui.buttons.button type="button" :button="__('green')" wire:click="publishBrand" wire:confirm="Are you sure you want to publish this brand?" :title="__('Publish')" class="rounded-md" />
            @endif
            <x-ui.buttons.button type="button" :button="__('blue')" wire:click="editBrand" :title="__('Edit')" class="rounded-md" />
            <x-ui.buttons.button type="button" :button="__('red')" wire:click="deleteBrand" :title="__('Delete')" class="rounded-md" />
        </div>
    </x-ui.card>
</section>
