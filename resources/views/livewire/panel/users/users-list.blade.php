<x-slot:title>{{ __('Users List') }}</x-slot>
<section class="grid gap-4">
    <x-panel.navigation>
        <div class="flex gap-4 w-full sm:max-w-xs">
            <x-ui.links.link :link="__('default')" wire:navigate href="{{ route('admin.users.add') }}" :title="__('Add New User')" class="font-medium rounded-md whitespace-nowrap" />
            <x-ui.form.select :for="__('type')" :title="__('Account Type')" wire:model.live="type" class="w-full">
                @foreach ($roles as $role)
                    <x-ui.form.option wire:key="role-{{ $role->id }}" :content="$role->name" value="{{ $role->id }}" />
                @endforeach
            </x-ui.form.select>
        </div>
        <x-ui.form.input type="search" :for="__('search')" wire:model.live="search" :placeholder="__('Search subscriber...')" class="sm:max-w-xs" />
    </x-panel.navigation>
    <x-ui.table>
        <x-ui.table.head>
            <x-ui.table.th :content="__('Name / Email')" />
            <x-ui.table.th :content="__('account type')" />
            <x-ui.table.th :content="__('Status')" />
            <x-ui.table.th :content="__('Action')" class="text-center" />
        </x-ui.table.head>
        <x-ui.table.body>
            @forelse($users as $user)
                <x-ui.table.tr wire:key="subscriber-{{ $user->id }}">
                    <x-ui.table.td>
                        <p>{{ $user->name }}</p>
                        <p>{{ $user->email }}</p>
                    </x-ui.table.td>
                    <x-ui.table.td :content="$user->role->name" />
                    <x-ui.table.td class="text-center">
                        @if ($user->status == 'active')
                            <x-ui.badge :badge="__('green')" :content="$user->status" class="uppercase" />
                        @else
                            <x-ui.badge :badge="__('red')" :content="$user->status" class="uppercase" />
                        @endif
                    </x-ui.table.td>
                    <x-ui.table.td class="text-center">
                        <x-ui.table.actions>
                            <x-ui.buttons.transparent-icon-button type="button" :button="__('default')" wire:click="userInformation('{{ $user->id }}')" :title="__('User Profile')" :icon="__('account_box')" class="rounded-md" />
                        </x-ui.table.actions>
                    </x-ui.table.td>
                </x-ui.table.tr>
            @empty
                <x-ui.table.tr>
                    <x-ui.table.td colspan="4" :content="__('Subscribers Not Found...')" class="text-center text-xl" />
                </x-ui.table.tr>
            @endforelse
        </x-ui.table.body>
    </x-ui.table>
</section>
