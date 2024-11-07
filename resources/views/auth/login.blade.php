<x-layouts.web>
    <x-slot:title>{{ __('Login') }}</x-slot>
    <section class="flex flex-col sm:justify-center items-center py-10 px-4 bg-gray-100 dark:bg-gray-900">
        <h1 class="text-3xl font-medium text-center mb-10 text-gray-950 dark:text-gray-200">{{ __('Login Account') }}</h1>
        @if (session('error'))
            <span class="text-white bg-red-500 px-4 py-2 rounded-md mb-2 text-center sm:max-w-sm">{{ session('error') }}</span>
        @endif
        <x-ui.card.index class="w-full sm:max-w-sm mx-auto p-4 rounded-xl">
            <p class="mb-2 text-center text-black dark:text-gray-200">{{ __('Please enter your credentials to login your account.') }}</p>
            <form method="POST" action="{{ route('login.store') }}">
                @csrf
                <x-ui.form.label :title="__('Email')" :for="__('email')">
                    <x-ui.form.input :for="__('email')" type="email" value="{{ old('email') }}" maxlength="64" autofocus required autocomplete="username" placeholder="{{ __('Email Address') }}" class="rounded-md" />
                </x-ui.form.label>
                <x-ui.form.label :title="__('Password')" :for="__('password')">
                    <x-ui.form.input-password :for="__('password')" minlength="8" maxlength="64" required autocomplete="off" placeholder="{{ __('Password') }}" class="rounded-md" />
                </x-ui.form.label>
                <div class="block mt-4 sm:col-span-2">
                    <x-ui.form.checkbox :box="__('default')" :title="__('Remember me')" :for="__('remember_me')" />
                </div>
                <div class="flex items-center justify-center mt-4">
                    <x-ui.buttons.button type="submit" :button="__('default')" :title="__('Log in')" class="w-full" />
                </div>
            </form>
        </x-ui.card.index>
        <p class="mt-4 text-center text-gray-800 dark:text-gray-200">
            {{ __('If you have no account yet click to') }}
            <a wire:navigate href="{{ route('register') }}" class="text-secondary-500 hover:text-primary-600 dark:hover:text-secondary-600 hover:underline">{{ __('Register') }}</a>
        </p>
    </section>
</x-layouts.web>
