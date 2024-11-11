@props(['title', 'for'])
<select {{ $attributes->merge(['class' => 'block w-full focus:border-primary-500 dark:focus:border-secondary-500 focus:ring-primary-500 dark:focus:ring-secondary-500 bg-white dark:bg-gray-800 text-black dark:text-white ' . ($errors->has($for) ? ' border-red-600 dark:border-red-500 ring-red-600 ring-red-500 focus:border-red-600 dark:focus:border-red-500 focus:ring-red-600 dark:focus:ring-red-500' : '') . ' form-input', 'id' => $for, 'name' => $for]) }}>
    <x-ui.form.option :content="__('-- ' . $title . ' -- ')" value="" selected class="cursor-not-allowed" />
    {{ $slot }}
</select>
