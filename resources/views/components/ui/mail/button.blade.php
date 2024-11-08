@props(['title'])
<a style="display: inline-block; background-color: #070a6e; color: white; padding: 10px 18px; text-decoration: none; border-radius: 5px;" {{ $attributes->merge(['title' => $title, 'target' => '_blank', 'rel' => 'noopener']) }}>{{ $title }}</a>
