@props(['content'])
<th {{ $attributes->merge(['class' => 'p-3 text-sm whitespace-nowrap']) }}>{{ $content ?? $slot }}</th>
