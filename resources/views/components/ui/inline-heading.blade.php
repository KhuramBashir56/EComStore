@props(['title', 'content'])
<div {{ $attributes->merge(['class' => 'flex items-start py-1 w-full']) }}>
    <span class="w-fit whitespace-nowrap capitalize pt-1 text-gray-900 dark:text-gray-300">{{ $title }} : </span>
    <strong class="w-full border-b flex items-center border-gray-900 dark:border-gray-500 pb-0.5 px-2 text-gray-900 dark:text-gray-200">{{ $content ?? $slot }}</strong>
</div>
