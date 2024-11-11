<x-slot:title>{{ __('Order Tracking') }}</x-slot>
<section class="flex flex-col sm:justify-center items-center py-10 px-4 bg-gray-100 dark:bg-gray-900">
    <h1 class="text-3xl font-medium text-center mb-10 text-gray-950 dark:text-gray-200">{{ __('Order Tracking') }}</h1>
    @if (session('error'))
        <span class="text-white bg-red-500 px-4 py-2 rounded-md mb-2 text-center sm:max-w-sm">{{ session('error') }}</span>
    @endif
    <x-ui.card class="w-full sm:max-w-sm mx-auto p-4 rounded-xl">
        <p class="mb-2 text-center text-black dark:text-gray-200">{{ __('Track your order using ') }}<strong>{{ __('Tracking Id') }}</strong>{{ __('.') }}</p>
        <x-ui.form.label :title="__('Tracking Id')" :for="__('tracking_id')">
            <x-ui.form.input type="text" wire:model="tracking_id" :for="__('tracking_id')" maxlength="10" autofocus required autocomplete="off" placeholder="{{ __('Tracking Id') }}" class="rounded-md" />
        </x-ui.form.label>
        <div class="flex items-center justify-center mt-4">
            <x-ui.buttons.button type="button" wire:click="track" :button="__('default')" :title="__('Track')" class="w-full" />
        </div>
    </x-ui.card>
    <p class="mt-4 text-center text-gray-800 dark:text-gray-200">
        {{ __('If you have any other question please') }}
        <a wire:navigate href="{{ route('register') }}" class="text-secondary-500 hover:text-primary-600 dark:hover:text-secondary-600 hover:underline">{{ __('Contact') }}</a>
        {{ __('our support team.') }}
    </p>
</section>
