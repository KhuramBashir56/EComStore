@props(['title'])
<div class="w-full flex sm:justify-between justify-center gap-4 sm:flex-row flex-col">
    {{ $title ?? $slot }}
</div>
