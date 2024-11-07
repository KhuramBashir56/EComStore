<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title . ' - ' . config('app.name') }}</title>
    <meta name="description" content="{{ $description ?? config('app.description') }}">
    <meta name="keywords" content="{{ $keywords ?? config('app.keywords') }}">
    <x-layouts.meta-data />
    <style type="text/css">
        .page {
            height: calc(100vh - 80px);
        }
    </style>
    @stack('styles')
</head>

<body>
    <x-panel.header />
    <div class="bg-gray-200 dark:bg-gray-900 overflow-y-auto relative page">
        {{ $slot }}
    </div>
    @stack('scripts')
</body>

</html>
