<footer class="py-8 bg-primary-500 dark:bg-gray-900 text-white dark:text-gray-200">
    <section class="px-4">
        <div class="2xl:container mx-auto">
            <div class="grid gap-4 lg:grid-cols-4 sm:grid-cols-2 place-items-start">
                <div class="w-full grid gap-4">
                    <div class="w-full flex items-center sm:justify-normal justify-center">
                        <x-logo class="size-24" />
                    </div>
                    <h3 class="text-xl font-bold sm:text-left text-center">{{ config('app.name') }}</h3>
                    <p>{{ config('app.description') }}</p>
                </div>
                <div class="w-full">skldja;sdfj</div>
                <div class="w-full">skldja;sdfj</div>
                <div class="w-full">skldja;sdfj</div>
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
                        <img src="{{ asset('assets/images/web/social-media/facebook.svg') }}" class="size-6" alt="Facebook">
                    </a>
                    <a href="#" class="flex items-center justify-center rounded-full p-2 hover:bg-gradient-to-bl from-blue-800 to-orange-400" title="Instagram">
                        <img src="{{ asset('assets/images/web/social-media/instagram.svg') }}" class="size-6" alt="Instagram">
                    </a>
                    <a href="#" class="flex items-center justify-center rounded-full p-2 hover:bg-green-700" title="Whatsapp">
                        <img src="{{ asset('assets/images/web/social-media/whatsapp.svg') }}" class="size-6" alt="Whatsapp">
                    </a>
                    <a href="#" class="flex items-center justify-center rounded-full p-2 hover:bg-black" title="Tiktok">
                        <img src="{{ asset('assets/images/web/social-media/tiktok.svg') }}" class="size-6" alt="Tiktok">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <hr class="border-primary-200 dark:border-gray-700 my-8">
    <section class="px-4">
        <div class="2xl:container mx-auto">
            <div class="flex flex-col justify-center items-center gap-4">
                <p class="text-center text-sm">Copyright &copy; 2023 - {{ now()->format('y') }} All rights reserved by <a href="{{ route('home') }}" class="text-secondary-500 hover:underline">{{ config('app.name') }}</a> </p>
            </div>
        </div>
    </section>
</footer>
