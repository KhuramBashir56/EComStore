<x-slot:title>{{ __('Units') }}</x-slot>
<section class="grid gap-4">
    <x-panel.navigation>
        <x-ui.buttons.button type="button" :button="__('default')" wire:click="addNewUnit" :title="__('Add New Unit')" class="font-medium rounded-md whitespace-nowrap" />
        <x-ui.form.input type="search" wire:model.live.debounce.500ms="search" :for="__('search')" placeholder="{{ __('Search unit...') }}" class="sm:max-w-xs" />
    </x-panel.navigation>
    <x-ui.table>
        <x-ui.table.head>
            <x-ui.table.th :content="__('Name')" />
            <x-ui.table.th :content="__('Short Code')" />
            <x-ui.table.th :content="__('Status')" />
            <x-ui.table.th :content="__('Action')" class="text-center" />
        </x-ui.table.head>
        <x-ui.table.body>
            @foreach ($units as $unit)
                <x-ui.table.tr wire:key="unit-{{ $unit->id }}">
                    <x-ui.table.td :content="$unit->name" />
                    <x-ui.table.td :content="$unit->code" class="uppercase" />
                    <x-ui.table.td class="text-center">
                        @if ($unit->status == 'published')
                            <x-ui.badge :badge="__('green')" :content="$unit->status" class="uppercase" />
                        @else
                            <x-ui.badge :badge="__('red')" :content="$unit->status" class="uppercase" />
                        @endif
                    </x-ui.table.td>
                    <x-ui.table.td class="text-center">
                        <x-ui.table.actions>
                            @if ($unit->status == 'published')
                                <x-ui.buttons.transparent-icon-button type="button" :button="__('red')" wire:click="unPublishUnit({{ $unit->id }})" wire:confirm="Are you sure you want to unpublish this unit?" :title="__('Un Publish')" :icon="__('visibility_off')" class="rounded-md" />
                            @else
                                <x-ui.buttons.transparent-icon-button type="button" :button="__('green')" wire:click="publishUnit({{ $unit->id }})" wire:confirm="Are you sure you want to publish this unit?" :title="__('Publish')" :icon="__('visibility')" class="rounded-md" />
                            @endif
                            <x-ui.buttons.transparent-icon-button type="button" :button="__('blue')" wire:click="editUnit({{ $unit->id }})" :title="__('Delete')" :icon="__('edit')" class="rounded-md" />
                            <x-ui.buttons.transparent-icon-button type="button" :button="__('red')" wire:click="deleteUnit({{ $unit->id }})" wire:confirm="Are you sure you want to delete this unit?" :title="__('Delete')" :icon="__('delete')" class="rounded-md" />
                        </x-ui.table.actions>
                    </x-ui.table.td>
                </x-ui.table.tr>
            @endforeach
        </x-ui.table.body>
    </x-ui.table>
    @if ($addUnitModal)
        <livewire:panel.products.units.add-new-unit />
    @endif
    @if ($editUnitModal)
        <livewire:panel.products.units.edit-unit :unit="$unit_id" />
    @endif
</section>
