<x-slot:title>{{ __('Departments List') }}</x-slot>
<section class="grid gap-4">
    <x-panel.navigation>
        <div></div>
        <x-ui.form.input type="search" :for="__('search')" wire:model.live="search" :placeholder="__('Search department...')" class="sm:max-w-xs" />
    </x-panel.navigation>
    <x-ui.table>
        <x-ui.table.head>
            <x-ui.table.th :content="__('Name / Department Description')" />
            <x-ui.table.th :content="__('Status')" />
            <x-ui.table.th :content="__('Action')" class="text-center" />
        </x-ui.table.head>
        <x-ui.table.body>
            @forelse($departments as $department)
                <x-ui.table.tr wire:key="department-{{ $department->id }}">
                    <x-ui.table.td>
                        <p class="text-lg font-bold">{{ $department->name }}</p>
                        <p>{{ $department->description }}</p>
                    </x-ui.table.td>
                    <x-ui.table.td class="text-center">
                        @if ($department->status == 'active')
                            <x-ui.badge :badge="__('green')" :content="$department->status" class="uppercase" />
                        @else
                            <x-ui.badge :badge="__('red')" :content="$department->status" class="uppercase" />
                        @endif
                    </x-ui.table.td>
                    <x-ui.table.td class="text-center">
                        <x-ui.table.actions>
                            @if ($department->status === 'active')
                                <x-ui.buttons.transparent-icon-button type="button" :button="__('red')" wire:click="inactiveDepartment('{{ $department->id }}')" wire:confirm="Are you sure you want to unpublish this department?" :title="__('Inactive')" :icon="__('visibility_off')" class="rounded-md" />
                            @else
                                <x-ui.buttons.transparent-icon-button type="button" :button="__('green')" wire:click="activeDepartment('{{ $department->id }}')" wire:confirm="Are you sure you want to publish this department?" :title="__('Active')" :icon="__('visibility')" class="rounded-md" />
                            @endif
                        </x-ui.table.actions>
                    </x-ui.table.td>
                </x-ui.table.tr>
            @empty
                <x-ui.table.tr>
                    <x-ui.table.td colspan="3" :content="__('Departments Not Found...')" class="text-center text-xl" />
                </x-ui.table.tr>
            @endforelse
        </x-ui.table.body>
    </x-ui.table>
</section>
