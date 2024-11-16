<x-slot:title>{{ __('Add New Product') }}</x-slot>
<section class="grid gap-4">
    <x-panel.navigation>
        <div class="w-full flex xs:gap-x-2 md:justify-start justify-center items-center">
            <x-ui.form.tab class="text-primary-500 dark:text-secondary-500" :index="1" :title="__('Overview')" :icon="__('keyboard_double_arrow_right')" />
            <x-ui.form.tab class="text-gray-400 dark:text-gray-600" :index="2" :title="__('Pricing & Colors')" :icon="__('keyboard_double_arrow_right')" />
            <x-ui.form.tab class="text-gray-400 dark:text-gray-600" :index="3" :title="__('Description')" :icon="__('keyboard_double_arrow_right')" />
            <x-ui.form.tab class="text-gray-400 dark:text-gray-600" :index="4" :title="__('Gallery')" :icon="__('keyboard_double_arrow_right')" />
            <x-ui.form.tab class="text-gray-400 dark:text-gray-600" :index="5" :title="__('Publish')" />
        </div>
    </x-panel.navigation>
    <x-ui.card class="w-full rounded-xl p-4 sm:grid-cols-2">
        <x-ui.form.label :title="__('Product Name / Title')" :for="__('name')" class="sm:col-span-2">
            <x-ui.form.input type="text" wire:model="name" :for="__('name')" maxlength="125" required placeholder="{{ __('Product Name / Title') }}" class="rounded-md" />
        </x-ui.form.label>
        <x-ui.form.label :title="__('Category Name')" :for="__('category')">
            <x-ui.form.select :for="__('category')" wire:model.live="category" required :title="__('Select Category Name')" class="rounded-md">
                @forelse ($categories as $category)
                    <x-ui.form.option wire:key="category-{{ $category->id }}" :content="__($category->name)" value="{{ $category->id }}" />
                @empty
                    <x-ui.form.option :content="__('Categories Not Found')" disabled value="" />
                @endforelse
            </x-ui.form.select>
        </x-ui.form.label>
        <x-ui.form.label :title="__('Sub Category Name')" :for="__('subCategory')">
            <x-ui.form.select :for="__('subCategory')" wire:model.live="subCategory" required :title="__('Select Sub Category Name')" class="rounded-md">
                @forelse ($subCategories as $category)
                    <x-ui.form.option wire:key="sub_category-{{ $category->id }}" :content="__($category->name)" value="{{ $category->id }}" />
                @empty
                    <x-ui.form.option :content="__('Sub Categories Not Found')" disabled value="" />
                @endforelse
            </x-ui.form.select>
        </x-ui.form.label>
        <x-ui.form.label :title="__('Brand Name')" :for="__('brand')">
            <x-ui.form.select :for="__('brand')" wire:model="brand" required :title="__('Select Brand Name')" class="rounded-md">
                @forelse ($brands as $brands)
                    <x-ui.form.option wire:key="brand-{{ $brands->id }}" :content="__($brands->name)" value="{{ $brands->id }}" />
                @empty
                    <x-ui.form.option :content="__('Brands Not Found')" disabled value="" />
                @endforelse
            </x-ui.form.select>
        </x-ui.form.label>
        <x-ui.form.label :title="__('Searching Keywords')" :for="__('keywords')" class="sm:col-span-2">
            <livewire:panel.components.keyword-input />
        </x-ui.form.label>
        <x-ui.form.label :title="__('Short Description')" :for="__('description')" class="sm:col-span-2">
            <x-ui.form.textarea :for="__('description')" wire:model="description" maxlength="155" required placeholder="{{ __('Short Description') }}" class="rounded-md" />
        </x-ui.form.label>
        <div class="flex justify-end gap-4 mt-2 sm:col-span-2">
            <x-ui.buttons.outline-button type="button" :button="__('red')" wire:click="cancel" wire:confirm="Are you sure you want to delete this form data?" :title="__('Cancel')" class="rounded-md" />
            <x-ui.buttons.button type="button" :button="__('green')" wire:click="saveProductOverview" :title="__('Save & Next')" class="rounded-md" />
        </div>
    </x-ui.card>
</section>
