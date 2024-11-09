@props(['content'])
<td {{ $attributes->merge(['class' => 'p-3 text-sm font-semibold']) }}>{{ $content ?? $slot }}</td>
