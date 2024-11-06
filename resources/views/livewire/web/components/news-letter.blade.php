<div class="bg-secondary-500 dark:bg-gray-800 py-16 px-4">
    <div class="max-w-5xl mx-auto text-center grid gap-6">
        <h2 class="md:text-4xl sm:text-3xl text-2xl font-bold text-white">Subscribe to Our Newsletter</h2>
        <p class="text-base text-white">Stay updated with the latest news, trends, and special offers. Don't miss out on our exciting updates.</p>
        <div class="w-full flex xs:flex-row flex-col gap-y-2 items-center overflow-hidden max-w-xl mx-auto xs:pe-1 xs:bg-white @error('email')
        bg-white
        @enderror">
            <div class="w-full flex flex-col items-start">
                <input type="email" wire:model='email' name="email" id="email" class="w-full px-3 py-2 focus:outline-none focus:ring-0 border-none focus:border-none bg-gray-100 focus:bg-white transition-colors duration-500 text-gray-950 text-xl" placeholder="Enter your email address">
                @error('email')
                    <p class="text-red-500 text-sm px-3 pt-1.5 ">{{ $message }}</p>
                @enderror
            </div>
            <x-ui.buttons.button type="button" :button="__('default')" wire:click="subscribe" :title="__('Subscribe')" class="uppercase xs:w-fit w-full font-medium self-start mt-1" />
        </div>
    </div>
</div>
