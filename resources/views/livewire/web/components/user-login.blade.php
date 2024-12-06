<x-ui.modal class="max-w-md">
    <x-ui.modal.header :title="__('Account Login')">
        <x-ui.modal.close-button wire:click="close" />
    </x-ui.modal.header>
    <x-ui.modal.body>
        <p class="mb-2 text-center text-black dark:text-gray-200">{{ __('Please enter your credentials to login your account.') }}</p>
        <x-ui.form.label :title="__('Email')" :for="__('user_email')">
            <x-ui.form.input type="email" :for="__('user_email')" wire:model="user_email" maxlength="64" autofocus required autocomplete="username" placeholder="{{ __('Email Address') }}" class="rounded-md" />
        </x-ui.form.label>
        <x-ui.form.label :title="__('Password')" :for="__('user_password')">
            <x-ui.form.input-password :for="__('user_password')" wire:model="user_password" minlength="8" maxlength="64" required autocomplete="off" placeholder="{{ __('Password') }}" class="rounded-md" />
        </x-ui.form.label>
        <div class="block text-end">
            <a wire:navigate href="{{ route('register') }}" class="text-secondary-500 hover:text-primary-600 dark:hover:text-secondary-600 hover:underline">{{ __('Forgot your password?') }}</a>
        </div>
        <div class="block mt-4">
            <x-ui.form.checkbox :box="__('default')" wire:model="remember_me" :title="__('Remember me')" :for="__('remember_me')" />
        </div>
        <div class="flex items-center justify-center mt-4">
            <x-ui.buttons.button type="button" wire:click="login" :button="__('default')" :title="__('Log in')" class="w-full" />
        </div>
    </x-ui.modal.body>
    <x-ui.modal.footer class="justify-center">
        <p class="text-center text-gray-800 dark:text-gray-200">
            {{ __('If you have no account yet click to') }}
            <a wire:navigate href="{{ route('register') }}" class="text-secondary-500 hover:text-primary-600 dark:hover:text-secondary-600 hover:underline">{{ __('Register') }}</a>
        </p>
    </x-ui.modal.footer>
</x-ui.modal>
