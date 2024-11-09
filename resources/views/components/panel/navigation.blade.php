@props(['title'])
<div class="w-full flex sm:justify-between justify-center gap-4 items-center sm:flex-row flex-col">
    {{ $title ?? $slot }}
</div>
