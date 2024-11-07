@props(['for'])
<div class="w-full relative" x-data="{ show: false }">
    <input :type="show ? 'text' : 'password'" {{ $attributes->merge(['class' => 'block w-full focus:border-primary-500 dark:focus:border-secondary-500 focus:ring-primary-500 dark:focus:ring-secondary-500 bg-white dark:bg-gray-800 text-black dark:text-white ' . ($errors->has($for) ? ' border-red-600 dark:border-red-500 ring-red-600 ring-red-500 focus:border-red-600 dark:focus:border-red-500 focus:ring-red-600 dark:focus:ring-red-500' : '') . ' form-input', 'id' => $for, 'name' => $for]) }} />
    <button type="button" class="w-fit aspect-square absolute right-2 top-1.5 text-gray-500 hover:text-primary-500 dark:hover:text-secondary-500 cursor-pointer flex items-center justify-center" title="Show password">
        <span class="material-symbols-outlined icon-filled text-2xl" style="display: none;" x-show="!show" x-on:click="show = !show">visibility</span>
        <span class="material-symbols-outlined icon-filled text-2xl" style="display: none;" x-show="show" x-on:click="show = !show">visibility_off</span>
    </button>
</div>
