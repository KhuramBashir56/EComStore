<div class="fixed inset-0 z-40 p-4 flex w-screen h-screen overflow-y-auto bg-black bg-opacity-90 sm:justify-center">
    <div {{ $attributes->merge(['class' => 'bg-white h-fit m-auto border-2 bg-secondary-50 dark:bg-gray-700 border-secondary-500 dark:border-gray-500 rounded-xl w-full']) }}>
        {{ $slot }}
    </div>
</div>
