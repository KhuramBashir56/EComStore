<x-layouts.errors>
    <x-slot name="title">{{ __('500 Internal Server Error') }}</x-slot>
    <x-slot name="description">{{ __('Contact the server administrator (' . config('app.email') . '), retry the request later, or check server logs for more details.') }}</x-slot>
</x-layouts.errors>
