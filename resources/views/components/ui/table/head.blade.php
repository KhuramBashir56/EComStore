<thead>
    <tr {{ $attributes->merge(['class' => 'font-semibold tracking-wide text-left uppercase border-b text-white bg-secondary-500 dark:bg-gray-600']) }}>
        {{ $slot }}
    </tr>
</thead>
