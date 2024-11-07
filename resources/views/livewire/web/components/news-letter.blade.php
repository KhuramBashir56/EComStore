<div class="bg-secondary-500 dark:bg-gray-800 py-16 px-4">
    <div class="max-w-5xl mx-auto text-center grid gap-6">
        <h2 class="md:text-4xl sm:text-3xl text-2xl font-bold text-white">Subscribe to Our Newsletter</h2>
        <p class="text-base text-white">Stay updated with the latest news, trends, and special offers. Don't miss out on our exciting updates.</p>
        <div class="w-full flex xs:flex-row flex-col gap-y-4 max-w-xl mx-auto xs:pe-1">
            <div class="w-full relative">
                <x-ui.form.input :for="__('email')" type="email" value="{{ old('email') }}" maxlength="64" required autocomplete="off" placeholder="{{ __('Email Address') }}" />
                @error('email')
                    <p class="text-red-500 text-xs absolute left-0 top-full">{{ $message }}</p>
                @enderror
            </div>
            <x-ui.buttons.button type="button" :button="__('default')" wire:click="subscribe" :title="__('Subscribe')" class="uppercase xs:w-fit w-full font-medium" />
        </div>
    </div>
</div>
