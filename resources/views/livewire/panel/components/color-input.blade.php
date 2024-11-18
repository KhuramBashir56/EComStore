<div class="w-full">
    @if (count($colors) + count($imageColors) < 12)
        <div class="flex flex-wrap sm:justify-start justify-center gap-4">
            <x-ui.form.radio-button :radio="__('default')" wire:model.live="type" value="singleColor" :title="__('Single Color')" :for="__('singleColor')" :name="__('color')" />
            <x-ui.form.radio-button :radio="__('default')" wire:model.live="type" value="combinationColor" :title="__('Combination Color')" :for="__('combinationColor')" :name="__('color')" />
            <x-ui.form.radio-button :radio="__('default')" wire:model.live="type" value="colorImage" :title="__('Color Images')" :for="__('colorImage')" :name="__('color')" />
        </div>
        <section class="mt-4">
            @if ($singleColor)
                <div class="grid gap-x-4 md:grid-cols-2">
                    <div class="w-full">
                        <x-ui.form.label :title="__('Color Name')" :for="__('name')">
                            <x-ui.form.input type="text" wire:model="name" :for="__('name')" maxlength="48" placeholder="{{ __('Color Name') }}" class="rounded-md" />
                        </x-ui.form.label>
                        <div class="flex flex-col xs:flex-row gap-x-4">
                            <x-ui.form.label :title="__('Color Code')" :for="__('primaryCode')">
                                <x-ui.form.input type="text" wire:model.live.debounce.1000ms="primaryCode" :for="__('primaryCode')" x-bind:value="$wire.primaryColor" maxlength="7" placeholder="{{ __('Hexadecimal Code') }}" class="rounded-md" />
                            </x-ui.form.label>
                            <x-ui.form.label :title="__('Color Picker')" :for="__('primaryColor')">
                                <div class="flex gap-4">
                                    <x-ui.form.input type="color" wire:model.live="primaryColor" :for="__('primaryColor')" class="rounded-md p-0 h-[42px] min-w-8" />
                                    <x-ui.buttons.button :button="__('default')" wire:click="saveSingleColor" :title="__('Add Color')" class="font-medium rounded-md whitespace-nowrap" />
                                </div>
                            </x-ui.form.label>
                        </div>
                    </div>
                </div>
            @elseif ($combinationColor)
                <div class="grid gap-x-4 md:grid-cols-2">
                    <div>
                        <x-ui.form.label :title="__('Color Name')" :for="__('name')">
                            <x-ui.form.input type="text" wire:model="name" :for="__('name')" maxlength="48" placeholder="{{ __('Color Name') }}" class="rounded-md" />
                        </x-ui.form.label>
                        <x-ui.form.label :title="__('Primary Color')" :for="__('primaryColor')" class="flex flex-col">
                            <div class="flex flex-col 2xs:flex-row gap-4">
                                <x-ui.form.input type="text" wire:model.live.debounce.1000ms="primaryCode" :for="__('primaryCode')" x-bind:value="$wire.primaryColor" maxlength="7" placeholder="{{ __('Hexadecimal Code') }}" class="rounded-md" />
                                <x-ui.form.input type="color" wire:model.live="primaryColor" :for="__('primaryColor')" class="rounded-md p-0 h-[42px] min-w-8" />
                            </div>
                        </x-ui.form.label>
                        <x-ui.form.label :title="__('Secondary Color')" :for="__('secondaryColor')">
                            <div class="flex flex-col 2xs:flex-row gap-4">
                                <x-ui.form.input type="text" wire:model.live.debounce.1000ms="secondaryCode" :for="__('secondaryCode')" x-bind:value="$wire.secondaryColor" maxlength="7" placeholder="{{ __('Hexadecimal Code') }}" class="rounded-md" />
                                <x-ui.form.input type="color" wire:model.live="secondaryColor" :for="__('secondaryColor')" class="rounded-md p-0 h-[42px] min-w-8" />
                            </div>
                        </x-ui.form.label>
                        <x-ui.buttons.button :button="__('default')" wire:click="saveCombinationColor" :title="__('Add Color')" class="font-medium rounded-md whitespace-nowrap w-full my-4" />
                    </div>
                </div>
            @elseif ($colorImage)
                <div class="grid gap-x-4 sm:grid-cols-2 mb-2">
                    <div class="w-full">
                        @if ($image)
                            <x-thumbnail :url="$image->temporaryUrl()" class="w-full max-w-36 mb-2 aspect-square" />
                        @else
                            <x-thumbnail class="w-full max-w-36 mb-2 aspect-square" />
                        @endif
                        <x-ui.form.label :title="__('Color Name')" :for="__('name')">
                            <x-ui.form.input type="text" wire:model="name" :for="__('name')" maxlength="48" placeholder="{{ __('Color Name') }}" class="rounded-md" />
                        </x-ui.form.label>
                        <x-ui.form.label :title="__('Color Image')" :for="__('image')">
                            <x-ui.form.input-file :for="__('image')" :size="__('100 KB')" wire:model="image" required accept="image/*" class="rounded-md" />
                        </x-ui.form.label>
                        <x-ui.buttons.button :button="__('default')" wire:click="saveColorImage" :title="__('Add Color')" class="font-medium rounded-md whitespace-nowrap w-full mt-4" />
                    </div>
                </div>
            @endif
        </section>
    @endif
    <x-ui.form.input-description :message="__('Select color form Color picker box or write color hexadecimal code and add. 12 colors are allowed to add for a product.')" />
    <div class="flex flex-wrap gap-4 mt-4">
        @foreach ($colors as $color)
            @php
                if ($color->primary && $color->secondary) {
                    $setColor = 'linear-gradient(to right, ' . $color->primary . ', ' . $color->secondary . ')';
                } else {
                    $setColor = $color->primary;
                }
            @endphp
            <x-ui.color-badge :name="$color->name" :color="$setColor" :image="null" class="uppercase">
                <x-ui.buttons.transparent-icon-button type="button" :button="__('red')" wire:click="removeColor({{ $color->id }})" wire:confirm="Are you sure you want to remove this color?" :title="__('Remove Color')" :icon="__('close')" class="rounded-md -me-2" />
            </x-ui.color-badge>
        @endforeach
        @foreach ($imageColors as $color)
            <x-ui.color-badge :name="$color->name" :color="null" :image="asset(config('filesystems.storage') . $color->path)" class="uppercase">
                <x-ui.buttons.transparent-icon-button type="button" :button="__('red')" wire:click="removeColorImage({{ $color->id }})" wire:confirm="Are you sure you want to remove this color image?" :title="__('Remove Color')" :icon="__('close')" class="rounded-md -me-2" />
            </x-ui.color-badge>
        @endforeach
    </div>
</div>

