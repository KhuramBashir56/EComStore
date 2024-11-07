@props(['title', 'for'])
<label {{ $attributes->merge(['class' => 'block w-full mb-3 text-md']) }} x-data="{ isRequired: false }" x-init="isRequired = $el.querySelector(['input', 'select', 'textarea']).hasAttribute('required')">
    <span class="text-black dark:text-gray-200 mb-1 flex items-center gap-1">
        <span>{{ $title }}</span>
        <span class="text-[10px] mt-1 text-gray-600 dark:text-gray-400" x-show="!isRequired">(Optional)</span>
        <span class="text-[10px] mt-1 text-gray-600 dark:text-gray-400" x-show="isRequired">(Required)</span>
    </span>
    {{ $slot }}
    @error($for)
        <x-ui.form.input-error :message="$message" />
    @enderror
</label>
