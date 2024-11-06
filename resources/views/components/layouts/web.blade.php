<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <x-layouts.meta-data />
    <style type="text/css">
        .page {
            height: calc(100vh - 40.8px);
        }

        @media screen and (min-width: 640px) {
            .page {
                height: 100vh;
            }
        }
    </style>
    @stack('styles')
</head>

<body>
    <div class="bg-gray-200 dark:bg-gray-900 overflow-y-auto relative page">
        <x-web.header />
        {{ $slot }}
        <livewire:web.components.news-letter />
        <x-web.footer />
        <x-alert-message />
    </div>
    @stack('scripts')
</body>

</html>
