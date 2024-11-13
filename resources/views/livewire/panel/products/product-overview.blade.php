<x-slot:title>{{ __('Add New Product') }}</x-slot>
<section class="grid gap-4">
    <x-panel.navigation>
        <div class="w-full flex xs:gap-x-2 md:justify-start justify-center items-center">
            <x-ui.form.tab class="text-primary-500 dark:text-secondary-500" :index="1" :title="__('Overview')" :icon="__('keyboard_double_arrow_right')" />
            <x-ui.form.tab class="text-gray-400" :index="2" :title="__('Pricing & Colors')" :icon="__('keyboard_double_arrow_right')" />
            <x-ui.form.tab class="text-gray-400" :index="3" :title="__('Description')" :icon="__('keyboard_double_arrow_right')" />
            <x-ui.form.tab class="text-gray-400" :index="4" :title="__('Gallery')" :icon="__('keyboard_double_arrow_right')" />
            <x-ui.form.tab class="text-gray-400" :index="5" :title="__('Publish')" />
        </div>
    </x-panel.navigation>
</section>
