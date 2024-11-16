<x-slot:title>{{ __('Latest Activities') }}</x-slot>
<section class="grid gap-4">
    <x-panel.navigation class="items-start">
        <div class="w-full sm:max-w-sm flex 2xs:flex-row flex-col gap-4 items-start">
            <div class="flex gap-4 w-full">
                <x-ui.buttons.icon-button type="button" :button="__('default')" wire:click="resetFiller" :title="__('Reset Filters')" :icon="__('refresh')" class="rounded-md p-2 mt-[1px]" />
                <x-ui.form.select :for="__('subject')" :title="__('All Activities')" wire:model.live="subject" class="w-full">
                    @foreach ($subjects as $subject)
                        <x-ui.form.option :content="$subject" value="{{ $subject }}" />
                    @endforeach
                </x-ui.form.select>
            </div>
            <x-ui.form.select :for="__('range')" :title="__('Records Range')" wire:model.live="range" class="2xs:max-w-20 w-full">
                <x-ui.form.option :content="__('25')" value="25" />
                <x-ui.form.option :content="__('50')" value="50" />
                <x-ui.form.option :content="__('100')" value="100" />
                <x-ui.form.option :content="__('250')" value="250" />
                <x-ui.form.option :content="__('500')" value="500" />
            </x-ui.form.select>
        </div>
        <div class="w-full sm:max-w-sm flex xs:flex-row flex-col gap-4">
            <div class="w-full">
                <x-ui.form.input type="date" :for="__('from')" wire:model="from" class="w-full" />
                @error('from')
                    <x-ui.form.input-error :message="$message" />
                @enderror
            </div>
            <div class="w-full">
                <x-ui.form.input type="date" :for="__('to')" wire:model.live="to" class="w-full" />
                @error('to')
                    <x-ui.form.input-error :message="$message" />
                @enderror
            </div>
        </div>
    </x-panel.navigation>
    <x-ui.table>
        <x-ui.table.head>
            <x-ui.table.th :content="__('date / time')" />
            <x-ui.table.th :content="__('Activity / Type / description')" />
            <x-ui.table.th :content="__('ip address / user agent')" />
        </x-ui.table.head>
        <x-ui.table.body>
            @forelse($activities as $activity)
                <x-ui.table.tr wire:key="activity-{{ $activity->id }}">
                    <x-ui.table.td>
                        <p>{{ $activity->last_activity->format('d M Y') }}</p>
                        <p>{{ $activity->last_activity->format('h:i:s A') }}</p>
                        <p>{{ $activity->last_activity->diffForHumans(null, true, true) . ' ago' }}</p>
                    </x-ui.table.td>
                    <x-ui.table.td>
                        <p>{{ $activity->subject }}</p>
                        <p class="capitalize">{{ $activity->type }}</p>
                        <p>{{ $activity->description ?? 'N/A' }}</p>
                    </x-ui.table.td>
                    <x-ui.table.td>
                        <p>{{ $activity->ip_address }}</p>
                        <p>{{ $activity->user_agent }}</p>
                    </x-ui.table.td>
                </x-ui.table.tr>
            @empty
                <x-ui.table.tr>
                    <x-ui.table.td colspan="5" :content="__('Latest Activity Not Found...')" class="text-center text-xl" />
                </x-ui.table.tr>
            @endforelse
        </x-ui.table.body>
    </x-ui.table>
    {{ $activities->links('components.ui.table.pagination') }}
</section>
