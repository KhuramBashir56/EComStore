<div class="w-full relative">
    @if (count($keywords) < 10)
        <x-ui.form.input type="text" :for="__('keyword')" wire:model="keyword" wire:keydown.enter="addKeyword" autocomplete="off" required maxlength="20" placeholder="Write keyword here and press enter" class="rounded-md" />
        @error('keyword')
            <x-ui.form.input-error :message="$message" />
        @enderror
        <x-ui.form.input-description :message="__('Write keyword and press enter or click to Add. Each keyword must be unique and maximum of 10 keywords')" />
        <x-ui.buttons.button type="button" :button="__('default')" wire:click="addKeyword" :title="__('Add Keyword')" class="rounded-r-[5px] py-2 absolute right-[1px] top-[0.7px]" />
    @endif
    @if (count($keywords) > 0)
        <div class="w-full mt-3 flex flex-wrap gap-2">
            @foreach ($keywords as $index => $keyword)
                <x-ui.badge :badge="__('blue')" class="uppercase">
                    <span>{{ $keyword }}</span>
                    <x-ui.buttons.icon-button type="button" :button="__('red')" wire:click="removeKeyword({{ $index }})" :title="__('Remove Keyword')" :icon="__('close')" class="rounded-md -me-2" />
                </x-ui.badge>
            @endforeach
        </div>
    @endif
</div>
