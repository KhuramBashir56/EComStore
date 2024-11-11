<x-layouts.web>
    <x-slot:title>{{ __('Register') }}</x-slot>
    <section class="flex flex-col sm:justify-center items-center py-10 px-4 bg-gray-100 dark:bg-gray-900">
        <h1 class="text-3xl font-medium text-center mb-10 text-gray-950 dark:text-gray-200">{{ __('Register Account') }}</h1>
        <x-ui.card class="w-full sm:max-w-2xl mx-auto p-4 rounded-xl">
            <p class="mb-2 text-center text-black dark:text-gray-200">{{ __('Please enter your credentials to login your account.') }}</p>
            <form method="POST" action="{{ route('register.store') }}" class="grid gap-x-4 sm:grid-cols-2">
                @csrf
                <x-ui.form.label :title="__('First Name')" :for="__('first_name')">
                    <x-ui.form.input type="text" :for="__('first_name')" value="{{ old('first_name') }}" maxlength="22" required autofocus autocomplete="given-name" placeholder="{{ __('First Name') }}" class="rounded-md" />
                </x-ui.form.label>
                <x-ui.form.label :title="__('Last Name')" :for="__('last_name')">
                    <x-ui.form.input type="text" :for="__('last_name')" value="{{ old('last_name') }}" maxlength="22" autocomplete="family-name" placeholder="{{ __('Last Name') }}" class="rounded-md" />
                </x-ui.form.label>
                <x-ui.form.label :title="__('Email')" :for="__('email')">
                    <x-ui.form.input type="email" :for="__('email')" value="{{ old('email') }}" maxlength="64" required autocomplete="username" placeholder="{{ __('Email Address') }}" class="rounded-md" />
                </x-ui.form.label>
                <x-ui.form.label :title="__('Phone')" :for="__('phone')">
                    <x-ui.form.input type="tel" :for="__('phone')" value="{{ old('phone') }}" minlength="11" maxlength="11" required autocomplete="tel" placeholder="{{ __('Phone Number') }}" class="rounded-md" />
                </x-ui.form.label>
                <x-ui.form.label :title="__('Password')" :for="__('password')">
                    <x-ui.form.input-password :for="__('password')" value="{{ old('password') }}" minlength="8" maxlength="64" required autocomplete="off" placeholder="{{ __('Password') }}" class="rounded-md" />
                </x-ui.form.label>
                <x-ui.form.label :title="__('Confirm Password')" :for="__('password_confirmation')">
                    <x-ui.form.input-password :for="__('password_confirmation')" vlaue="{{ old('password_confirmation') }}" minlength="8" maxlength="64" required autocomplete="off" placeholder="{{ __('Confirm Password') }}" class="rounded-md" />
                </x-ui.form.label>
                <div class="block mt-4 sm:col-span-2">
                    <x-ui.form.checkbox :box="__('default')" :for="__('policy_accept')">
                        <p class="text-center text-gray-800 dark:text-gray-200">
                            {{ __('I have read and accept the ') }}
                            <a wire:navigate href="{{ route('login') }}" class="text-secondary-500 hover:text-primary-600 dark:hover:text-secondary-600 hover:underline">{{ __('Privacy Policy') }}</a>
                        </p>
                    </x-ui.form.checkbox>
                    @error('policy_accept')
                        <x-ui.form.input-error :message="$message" />
                    @enderror
                </div>
                <div class="flex items-center justify-center mt-4 sm:col-span-2">
                    <x-ui.buttons.button type="submit" :button="__('default')" :title="__('Register')" class="w-full" />
                </div>
            </form>
        </x-ui.card>
        <p class="mt-4 text-center text-gray-800 dark:text-gray-200">
            {{ __('You have already have an account, please ') }}
            <a wire:navigate href="{{ route('login') }}" class="text-secondary-500 hover:text-primary-600 dark:hover:text-secondary-600 hover:underline">{{ __('Login') }}</a>
        </p>
    </section>
</x-layouts.web>
