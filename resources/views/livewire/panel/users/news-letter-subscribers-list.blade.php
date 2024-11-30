<x-slot:title>{{ __('News Letter Subscribers') }}</x-slot>
<section class="grid gap-4">
    <x-panel.navigation>
        <x-ui.form.select :for="__('range')" :title="__('Records Range')" wire:model.live="range" class="2xs:max-w-20 w-full">
            <x-ui.form.option :content="__('25')" value="25" />
            <x-ui.form.option :content="__('50')" value="50" />
            <x-ui.form.option :content="__('100')" value="100" />
            <x-ui.form.option :content="__('250')" value="250" />
            <x-ui.form.option :content="__('500')" value="500" />
        </x-ui.form.select>
        <x-ui.form.input type="search" :for="__('search')" wire:model.live="search" :placeholder="__('Search subscriber...')" class="sm:max-w-xs" />
    </x-panel.navigation>
    <x-ui.table>
        <x-ui.table.head>
            <x-ui.table.th :content="__('email')" />
            <x-ui.table.th :content="__('Subscribed At')" />
            <x-ui.table.th :content="__('Status')" />
            <x-ui.table.th :content="__('Action')" class="text-center" />
        </x-ui.table.head>
        <x-ui.table.body>
            @forelse($subscribers as $subscriber)
                <x-ui.table.tr wire:key="subscriber-{{ $subscriber->id }}">
                    <x-ui.table.td :content="$subscriber->email" />
                    <x-ui.table.td :content="$subscriber->updated_at ? $subscriber->updated_at->format('d M Y h:i:s A') : 'N/A'" />
                    <x-ui.table.td class="text-center">
                        @if ($subscriber->status == 'verified')
                            <x-ui.badge :badge="__('green')" :content="$subscriber->status" class="uppercase" />
                        @else
                            <x-ui.badge :badge="__('red')" :content="$subscriber->status" class="uppercase" />
                        @endif
                    </x-ui.table.td>
                    <x-ui.table.td class="text-center">
                        <x-ui.table.actions>
                            <x-ui.buttons.transparent-icon-button type="button" :button="__('red')" wire:click="deleteSubscriber({{ $subscriber->id }})" wire:confirm="Are you sure you want to delete this subscriber? Subscriber will be deleted permanently." :title="__('Delete')" :icon="__('delete')" class="rounded-md" />
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
    {{ $subscribers->links('components.ui.table.pagination') }}
</section>
