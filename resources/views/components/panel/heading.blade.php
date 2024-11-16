@props(['title'])
<div class="w-full flex justify-between border-b-2 border-gray-400 mb-4">
    <h3 {{ $attributes->merge(['class' => 'w-fit border-b-2 -mb-0.5 font-medium pb-1.5 text-gray-900 dark:text-gray-200']) }}>{{ $title }}</h3>
    {{ $slot }}
</div>
