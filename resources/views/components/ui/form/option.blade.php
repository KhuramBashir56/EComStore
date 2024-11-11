@props(['content'])
<option {{ $attributes->merge(['class' => 'text-lg capitalize font-medium']) }}>{{ $content }}</option>
