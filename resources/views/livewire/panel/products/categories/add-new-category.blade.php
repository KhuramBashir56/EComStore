<x-slot:title>{{ __('Add New Category') }}</x-slot>
<section class="grid gap-4">
    <x-ui.card class="w-full rounded-xl p-4 sm:grid-cols-2">
        <div class="sm:col-span-2 mb-4">
            @if ($thumbnail)
                <x-thumbnail :url="$thumbnail->temporaryUrl()" class="w-full sm:max-w-56 aspect-square" />
            @else
                <x-thumbnail class="w-full sm:max-w-56 aspect-square" />
            @endif
        </div>
        <x-ui.form.label :title="__('Category Name')" :for="__('name')">
            <x-ui.form.input type="text" wire:model="name" :for="__('name')" maxlength="48" required placeholder="{{ __('Category Name') }}" class="rounded-md" />
        </x-ui.form.label>
        <x-ui.form.label :title="__('Category Thumbnail')" :for="__('thumbnail')">
            <x-ui.form.input-file :for="__('thumbnail')" :size="__('512 KB')" wire:model="thumbnail" required accept="image/*" class="rounded-md" />
        </x-ui.form.label>
        <x-ui.form.label :title="__('Category Keywords')" :for="__('keywords')" class="sm:col-span-2">
            <livewire:panel.components.keyword-input />
        </x-ui.form.label>
        <x-ui.form.label :title="__('Category Description')" :for="__('description')" class="sm:col-span-2">
            <x-ui.form.textarea :for="__('description')" wire:model="description" maxlength="155" required placeholder="{{ __('Category Description') }}" class="rounded-md" />
        </x-ui.form.label>
        <div class="flex justify-end gap-4 mt-4 sm:col-span-2">
            <x-ui.buttons.outline-button type="button" :button="__('red')" wire:click="cancel" wire:confirm="Are you sure you want to delete this form data?" :title="__('Cancel')" class="rounded-md" />
            <x-ui.buttons.button type="button" :button="__('green')" wire:click="saveCategory" :title="__('Save')" class="rounded-md" />
        </div>
    </x-ui.card>
</section>
