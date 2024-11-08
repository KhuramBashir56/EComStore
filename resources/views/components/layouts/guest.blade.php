<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="robots" content="noindex, nofollow">
    <title>{{ $title . ' - ' . config('app.name') }}</title>
    <meta name="description" content="{{ config('app.description') }}">
    <x-layouts.meta-data />
</head>

<body>
    <div class="h-screen bg-white items-center flex flex-col justify-center p-4 gap-4">
        <x-logo class="size-48" />
        <div class="font-bold">
            <h3 class="text-center text-3xl text-gray-800">{{ $title }}</h3>
        </div>
        <p class="text-base max-w-lg text-center">{{ $description }}</p>
        <x-ui.links.link href="{{ route('home') }}" :link="__('default')" :title="__('Go Back to Home Page')" class="bg-primary-500 text-white hover:bg-primary-600" />
    </div>
</body>

</html>
