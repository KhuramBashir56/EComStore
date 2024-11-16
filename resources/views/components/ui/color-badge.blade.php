@props(['name', 'color', 'image'])
<span class="inline-flex gap-x-2 items-center ps-2 pe-3 py-1 text-sm font-medium rounded-md uppercase border-2 border-gray-500 dark:border-gray-600">
    @if ($color)
        <span class="size-6 rounded border-2 border-white" style="background: {{ $color }} !important;"></span>
    @endif
    @if ($image)
        <img class="size-6 rounded border-2 border-white" src="{{ $image }}" alt="{{ $name }}">
    @endif
    <span class="text-gray-900 dark:text-gray-200" title="{{ $name }}">{{ $name }}</span>
    {{ $slot }}
</span>
