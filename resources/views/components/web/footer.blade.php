<footer class="py-8 bg-primary-500 dark:bg-gray-900 text-white dark:text-gray-200">
    <section class="px-4">
        <div class="2xl:container mx-auto">
            <div class="grid gap-4 lg:grid-cols-4 sm:grid-cols-2 place-items-start">
                <div class="w-full grid gap-4">
                    <div class="w-full flex items-center sm:justify-normal justify-center">
                        <x-logo wire:navigate class="size-24" />
                    </div>
                    <h3 class="text-xl font-bold sm:text-left text-center">{{ config('app.name') }}</h3>
                    <p>{{ config('app.description') }}</p>
                </div>
                <div class="w-full">
                    <x-web.heading :title="__('Most Useable Links')" class="text-xl border-secondary-500" />
                    <div class="w-full divide-y divide-primary-200 dark:divide-gray-600">
                        <a wire:navigate href="{{ route('home') }}" class="flex items-center px-3 py-2 hover:bg-secondary-500 dark:hover:bg-gray-700 transition-colors duration-500">Home</a>
                        <a wire:navigate href="" class="flex items-center px-3 py-2 hover:bg-secondary-500 dark:hover:bg-gray-700 transition-colors duration-500">Products</a>
                        <a wire:navigate href="{{ route('order.tracking') }}" class="flex items-center px-3 py-2 hover:bg-secondary-500 dark:hover:bg-gray-700 transition-colors duration-500">Track Order</a>
                        <a wire:navigate href="" class="flex items-center px-3 py-2 hover:bg-secondary-500 dark:hover:bg-gray-700 transition-colors duration-500">About Us</a>
                        <a wire:navigate href="{{ route('contact') }}" class="flex items-center px-3 py-2 hover:bg-secondary-500 dark:hover:bg-gray-700 transition-colors duration-500">Contact Us</a>
                        <a wire:navigate href="" class="flex items-center px-3 py-2 hover:bg-secondary-500 dark:hover:bg-gray-700 transition-colors duration-500">FAQs</a>
                        @guest
                            <a wire:navigate href="{{ route('login') }}" class="flex items-center px-3 py-2 hover:bg-secondary-500 dark:hover:bg-gray-700 transition-colors duration-500">Login</a>
                            <a wire:navigate href="{{ route('register') }}" class="flex items-center px-3 py-2 hover:bg-secondary-500 dark:hover:bg-gray-700 transition-colors duration-500">Register</a>
                        @endguest
                    </div>
                </div>
                <div class="w-full">
                    <x-web.heading :title="__('Categories')" class="text-xl border-secondary-500" />
                    <livewire:web.components.footer.categories lazy />
                </div>
                <div class="w-full">
                    <div class="w-full">
                        <x-web.heading :title="__('Legal Links')" class="text-xl border-secondary-500" />
                        <div class="w-full divide-y divide-primary-200 dark:divide-gray-600">
                            <a wire:navigate href="" class="flex items-center px-3 py-2 hover:bg-secondary-500 dark:hover:bg-gray-700 transition-colors duration-500">Privacy Policy</a>
                            <a wire:navigate href="" class="flex items-center px-3 py-2 hover:bg-secondary-500 dark:hover:bg-gray-700 transition-colors duration-500">Terms & Conditions</a>
                            <a wire:navigate href="" class="flex items-center px-3 py-2 hover:bg-secondary-500 dark:hover:bg-gray-700 transition-colors duration-500">Return Policy & Method</a>
                            <a wire:navigate href="" class="flex items-center px-3 py-2 hover:bg-secondary-500 dark:hover:bg-gray-700 transition-colors duration-500">Refund Process & Policy</a>
                        </div>
                    </div>
                    <div class="w-full mt-4">
                        <x-web.heading :title="__('Contact Information')" class="text-xl border-secondary-500" />
                        <div class="w-full grid gap-2 divide-y divide-primary-200 dark:divide-gray-600">
                            <div class="flex items-center gap-3 py-2">
                                <img src="{{ asset('assets/images/web/social-media/whatsapp.svg') }}" alt="Whatsapp" class="size-5" loading="lazy">
                                <div class="flex flex-col">
                                    <address>{{ config('app.whatsapp') }}</address>
                                    <span class="text-xs">Monday - Saturday, 8AM - 8PM</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 py-2">
                                <img src="{{ asset('assets/images/web/telephone.svg') }}" alt="Phone" class="size-5" loading="lazy">
                                <div class="flex flex-col">
                                    <address>{{ config('app.phone') }}</address>
                                    <span class="text-xs">Monday - Saturday, 8AM - 8PM</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 py-2">
                                <img src="{{ asset('assets/images/web/envelope.svg') }}" alt="Email" class="size-5" loading="lazy">
                                <div class="flex flex-col">
                                    <address>{{ config('app.email') }}</address>
                                    <span class="text-xs">27/7, 8AM - 8PM</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 py-2">
                                <img src="{{ asset('assets/images/web/geo-alt.svg') }}" alt="Address" class="size-5" loading="lazy">
                                <div class="flex flex-col">
                                    <address>{{ config('app.address') }}</address>
                                    <span class="text-xs">Monday - Saturday, 8AM - 8PM</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr class="border-primary-200 dark:border-gray-700 my-8">
    <section class="px-4">
        <div class="2xl:container mx-auto">
            <div class="grid gap-4 md:grid-cols-2">
                <livewire:web.components.footer.payment-methods lazy />
                <div class="flex gap-4 items-center md:justify-end justify-center">
                    <a href="#" class="flex items-center justify-center rounded-full p-2 hover:bg-sky-700" title="Facebook">
                        <img src="{{ asset('assets/images/web/social-media/facebook.svg') }}" loading="lazy" class="size-6" alt="Facebook">
                    </a>
                    <a href="#" class="flex items-center justify-center rounded-full p-2 hover:bg-gradient-to-bl from-blue-800 to-orange-400" title="Instagram">
                        <img src="{{ asset('assets/images/web/social-media/instagram.svg') }}" loading="lazy" class="size-6" alt="Instagram">
                    </a>
                    <a href="#" class="flex items-center justify-center rounded-full p-2 hover:bg-green-700" title="Whatsapp">
                        <img src="{{ asset('assets/images/web/social-media/whatsapp.svg') }}" loading="lazy" class="size-6" alt="Whatsapp">
                    </a>
                    <a href="#" class="flex items-center justify-center rounded-full p-2 hover:bg-black" title="Tiktok">
                        <img src="{{ asset('assets/images/web/social-media/tiktok.svg') }}" loading="lazy" class="size-6" alt="Tiktok">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <hr class="border-primary-200 dark:border-gray-700 my-8">
    <section class="px-4">
        <div class="2xl:container mx-auto">
            <div class="flex flex-col justify-center items-center gap-4">
                <p class="text-center text-sm">&copy; 2023 - {{ now()->format('y') }} All rights reserved by <a href="{{ route('home') }}" class="text-secondary-500 hover:underline">{{ config('app.name') }}</a> v:1.0 </p>
            </div>
        </div>
    </section>
</footer>
