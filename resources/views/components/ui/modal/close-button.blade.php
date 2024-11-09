<button {{ $attributes->merge(['class' => 'flex absolute right-5 top-4 items-center justify-center ms-2 text-sm text-secondary-100 dark:text-gray-600 hover:text-white dark:hover:text-gray-200 bg-transparent transition-colors duration-500']) }} title="Close" wire:loading.attr="disabled" wire:offline.attr="disabled" wire:loading.class="cursor-wait" type="button">
    <span class="material-symbols-outlined">close</span>
</button>
