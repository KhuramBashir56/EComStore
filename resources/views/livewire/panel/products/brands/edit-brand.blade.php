<x-slot:title>{{ __('Edit Brand') }}</x-slot>
<section class="grid gap-4">
    <x-ui.card class="w-full rounded-xl p-4 sm:grid-cols-2">
        <div class="sm:col-span-2 mb-4">
            @if ($logo)
                <x-thumbnail :url="$logo->temporaryUrl()" class="w-full sm:max-w-56 aspect-square" />
            @else
                <x-thumbnail :url="asset(config('filesystems.storage') . $old_logo)" class="w-full sm:max-w-56 aspect-square" />
            @endif
        </div>
        <x-ui.form.label :title="__('Brand Name')" :for="__('name')">
            <x-ui.form.input type="text" wire:model="name" :for="__('name')" maxlength="48" required placeholder="{{ __('Brand Name') }}" class="rounded-md" />
        </x-ui.form.label>
        <x-ui.form.label :title="__('Brand Logo')" :for="__('logo')">
            <x-ui.form.input-file :for="__('logo')" :size="__('512 KB')" wire:model="logo" required accept="image/*" class="rounded-md" />
        </x-ui.form.label>
        <x-ui.form.label :title="__('Brand Keywords')" :for="__('keywords')" class="sm:col-span-2">
            <livewire:panel.components.keyword-input :keywords="$keywords" />
        </x-ui.form.label>
        <x-ui.form.label :title="__('Brand Description')" :for="__('description')" class="sm:col-span-2">
            <x-ui.form.textarea :for="__('description')" wire:model="description" maxlength="155" required placeholder="{{ __('Brand Description') }}" class="rounded-md" />
        </x-ui.form.label>
        <div class="flex justify-end gap-4 mt-4 sm:col-span-2">
            <x-ui.buttons.outline-button type="button" :button="__('red')" wire:click="cancel" wire:confirm="Are you sure you want to delete this form data?" :title="__('Cancel')" class="rounded-md" />
            <x-ui.buttons.button type="button" :button="__('green')" wire:click="updateBrand" :title="__('Update')" class="rounded-md" />
        </div>
    </x-ui.card>
</section>
