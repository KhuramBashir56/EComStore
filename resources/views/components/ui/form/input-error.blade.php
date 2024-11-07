@props(['message'])
<span {{ $attributes->merge(['class' => 'block text-xs text-red-600 dark:text-red-500']) }}>{{ $message }}</span>
