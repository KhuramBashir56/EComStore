<div class="flex w-full max-w-lg mx-auto border-2 border-primary-500 dark:border-secondary-500">
    <x-ui.form.input type="search" :for="__('search')" maxlength="64" autocomplete="off" placeholder="{{ __('Start typing to search...') }}" class="text-xl" />
    <x-ui.buttons.icon-button type="button" :button="__('default')" wire:click="search" :title="__('Search')" :icon="__('search')" />
</div>
