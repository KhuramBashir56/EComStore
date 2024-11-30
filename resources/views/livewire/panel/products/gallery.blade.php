<x-slot:title>{{ __('Add New Product') }}</x-slot>
<section class="grid gap-4">
    <x-panel.navigation>
        <div class="w-full flex xs:gap-x-2 md:justify-start justify-center items-center">
            <x-ui.form.tab class="{{ $product->ref_id ? 'text-gray-900 dark:text-gray-100' : 'text-gray-400 dark:text-gray-600' }}" :index="1" :title="__('Overview')" :icon="__('keyboard_double_arrow_right')" />
            <x-ui.form.tab class="{{ $product->unit_id ? 'text-gray-900 dark:text-gray-100' : 'text-gray-400 dark:text-gray-600' }}" :index="2" :title="__('Pricing & Colors')" :icon="__('keyboard_double_arrow_right')" />
            <x-ui.form.tab class="{{ $product->description ? 'text-gray-900 dark:text-gray-100' : 'text-gray-400 dark:text-gray-600' }}" :index="3" :title="__('Description')" :icon="__('keyboard_double_arrow_right')" />
            <x-ui.form.tab class="text-primary-500 dark:text-secondary-500" :index="4" :title="__('Gallery')" :icon="__('keyboard_double_arrow_right')" />
            <x-ui.form.tab class="text-gray-400 dark:text-gray-600" :index="5" :title="__('Publish')" />
        </div>
    </x-panel.navigation>

    <x-ui.card class="p-4 sm:grid-cols-2">

        <div class="flex justify-end gap-4 mt-2 sm:col-span-2">
            <x-ui.links.outline-link :link="__('red')" wire:navigate href="{{ route('admin.products.add_product.content_and_description', ['product' => $product->ref_id]) }}" :title="__('Go Back')" class="rounded-md" />
            <x-ui.buttons.button type="button" :button="__('green')" wire:click="saveGallery" :title="__('Save & Next')" class="rounded-md" />
        </div>
    </x-ui.card>
</section>
