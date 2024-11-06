<div class="flex items-center justify-between w-fit">
    <a wire:navigate href="{{ route('home') }}" class="inline-block">
        <img src="{{ asset('assets/images/logo.png') }}" {{ $attributes->merge(['alt' => 'logo']) }}>
    </a>
</div>
