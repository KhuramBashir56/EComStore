<x-ui.modal class="max-w-md">
    <x-ui.modal.header :title="__('Edit Unit')">
        <x-ui.modal.close-button wire:click="cancel" />
    </x-ui.modal.header>
    <x-ui.modal.body>
        <x-ui.form.label :title="__('Unit Name')" :for="__('name')">
            <x-ui.form.input type="text" wire:model="name" :for="__('name')" maxlength="48" required placeholder="{{ __('Unit Name') }}" class="rounded-md" />
        </x-ui.form.label>
        <x-ui.form.label :title="__('Unit Code')" :for="__('code')">
            <x-ui.form.input type="text" wire:model="code" :for="__('code')" maxlength="3" required placeholder="{{ __('Unit Code') }}" class="rounded-md" />
        </x-ui.form.label>
    </x-ui.modal.body>
    <x-ui.modal.footer class="justify-end">
        <x-ui.buttons.outline-button type="button" :button="__('red')" wire:click="cancel" wire:confirming="Are you sure you want to delete this form data?" :title="__('Cancel')" class="font-medium rounded-md" />
        <x-ui.buttons.button type="button" :button="__('green')" wire:click="updateUnit" :title="__('Save')" class="font-medium rounded-md" />
    </x-ui.modal.footer>
</x-ui.modal>
