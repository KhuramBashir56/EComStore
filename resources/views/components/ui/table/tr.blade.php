<tr {{ $attributes->merge(['class' => 'text-black dark:text-gray-200 bg-gray-100 dark:bg-gray-800 hover:bg-secondary-50 dark:hover:bg-gray-700 transition-colors duration-500']) }}>
    {{ $slot }}
</tr>
