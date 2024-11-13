<x-slot:title>{{ __('Assign Categories to ') . $brand->name }}</x-slot>
<section class="grid gap-4">
    <x-panel.navigation>
        <x-ui.links.link :link="__('default')" wire:navigate href="{{ route('admin.products.brands.details', ['brand' => $brand->id]) }}" :title="__('Go Back')" class="font-medium whitespace-nowrap rounded-md" />
        <x-ui.form.input type="search" wire:model.live.debounce.500ms="search" :for="__('search')" placeholder="{{ __('Search category...') }}" class="sm:max-w-xs" />
    </x-panel.navigation>
    <x-ui.table>
        <x-ui.table.head>
            <x-ui.table.th :content="__('Sub Category Name')" />
            <x-ui.table.th :content="__('Category Name')" />
            <x-ui.table.th :content="__('Action')" class="text=center" />
        </x-ui.table.head>
        <x-ui.table.body>
            @forelse ($categories as $category)
                <x-ui.table.tr wire:key="sub-category-{{ $category->id }}">
                    <x-ui.table.td :content="$category->name" />
                    <x-ui.table.td :content="$category->category->name" />
                    <x-ui.table.td>
                        <x-ui.buttons.button :button="__('green')" :title="__('Add')" wire:click="addCategory({{ $category->id }})" wire:confirm="Are you sure you want to add this category?" class="rounded-md" />
                    </x-ui.table.td>
                </x-ui.table.tr>
            @empty
                <x-ui.table.tr>
                    <x-ui.table.td colspan="3" :content="__('Categories Not Found...')" class="text-center text-xl" />
                </x-ui.table.tr>
            @endforelse
        </x-ui.table.body>
    </x-ui.table>
</section>
