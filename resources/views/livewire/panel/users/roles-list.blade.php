<x-slot:title>{{ __('Roles List') }}</x-slot>
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
            @forelse($roles as $role)
                <x-ui.table.tr wire:key="department-{{ $role->id }}">
                    <x-ui.table.td>
                        <p class="text-lg font-bold">{{ $role->name }}</p>
                        <p>{{ $role->description }}</p>
                    </x-ui.table.td>
                    <x-ui.table.td class="text-center">
                        @if ($role->status == 'active')
                            <x-ui.badge :badge="__('green')" :content="$role->status" class="uppercase" />
                        @else
                            <x-ui.badge :badge="__('red')" :content="$role->status" class="uppercase" />
                        @endif
                    </x-ui.table.td>
                    <x-ui.table.td class="text-center">
                        <x-ui.table.actions>
                            @if ($role->status === 'active')
                                <x-ui.buttons.transparent-icon-button type="button" :button="__('red')" wire:click="inactiveRole('{{ $role->id }}')" wire:confirm="Are you sure you want to unpublish this role?" :title="__('Inactive')" :icon="__('visibility_off')" class="rounded-md" />
                            @else
                                <x-ui.buttons.transparent-icon-button type="button" :button="__('green')" wire:click="activeRole('{{ $role->id }}')" wire:confirm="Are you sure you want to publish this role?" :title="__('Active')" :icon="__('visibility')" class="rounded-md" />
                            @endif
                        </x-ui.table.actions>
                    </x-ui.table.td>
                </x-ui.table.tr>
            @empty
                <x-ui.table.tr>
                    <x-ui.table.td colspan="3" :content="__('Roles Not Found...')" class="text-center text-xl" />
                </x-ui.table.tr>
            @endforelse
        </x-ui.table.body>
    </x-ui.table>
</section>
