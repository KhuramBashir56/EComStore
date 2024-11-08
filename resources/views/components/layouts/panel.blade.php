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
        .panel_page {
            height: calc(100vh - 80px);
        }

        .mainMenu {
            height: calc(100% - 26px);
        }
    </style>
    @stack('styles')
</head>

<body>
    <x-panel.header />
    <section class="xl:flex items-start bg-gray-200 dark:bg-gray-900 relative panel_page">
        <x-panel.menu-bar.index />
        <main class="w-full h-full overflow-y-auto p-4 grid gap-4 place-content-start">
            <h3 class="w-full font-medium text-2xl text-black dark:text-gray-200">{{ $title }}</h3>
            {{ $slot }}
        </main>
        <x-alert-message />
    </section>
    @stack('scripts')
</body>

</html>
