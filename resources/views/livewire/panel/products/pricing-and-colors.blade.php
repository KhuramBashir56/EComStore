<x-slot:title>{{ __('Add New Product') }}</x-slot>
<section class="grid gap-4">
    <x-panel.navigation>
        <div class="w-full flex xs:gap-x-2 md:justify-start justify-center items-center">
            <x-ui.form.tab class="text-gray-900 dark:text-gray-100" :index="1" :title="__('Overview')" :icon="__('keyboard_double_arrow_right')" />
            <x-ui.form.tab class="text-primary-500 dark:text-secondary-500" :index="2" :title="__('Pricing & Colors')" :icon="__('keyboard_double_arrow_right')" />
            <x-ui.form.tab class="text-gray-400 dark:text-gray-600" :index="3" :title="__('Description')" :icon="__('keyboard_double_arrow_right')" />
            <x-ui.form.tab class="text-gray-400 dark:text-gray-600" :index="4" :title="__('Gallery')" :icon="__('keyboard_double_arrow_right')" />
            <x-ui.form.tab class="text-gray-400 dark:text-gray-600" :index="5" :title="__('Publish')" />
        </div>
    </x-panel.navigation>
    <x-ui.card class="w-full rounded-xl p-4 ">
        <div class="w-full">
            <x-panel.heading :title="__('Product Pricing')" class="text-xl border-secondary-500" />
            <div class="grid gap-x-4 md:grid-cols-4 xs:grid-cols-2">
                <x-ui.form.label :title="__('Quantity')" :for="__('quantity')">
                    <x-ui.form.input type="number" wire:model="quantity" :for="__('quantity')" required min="1" max="9999" autocomplete="off" placeholder="{{ __('Quantity') }}" class="rounded-md" />
                </x-ui.form.label>
                <x-ui.form.label :title="__('Product Unit')" :for="__('unit')">
                    <x-ui.form.select :for="__('unit')" wire:model.live="unit" required :title="__('Select Product Unit')" class="rounded-md">
                        @forelse ($units as $unit)
                            <x-ui.form.option wire:key="unit-{{ $unit->id }}" :content="__($unit->name . ' (' . $unit->code . ')')" value="{{ $unit->id }}" />
                        @empty
                            <x-ui.form.option :content="__('Units Not Found')" disabled value="" />
                        @endforelse
                    </x-ui.form.select>
                </x-ui.form.label>
                <x-ui.form.label :title="__('Price')" :for="__('price')">
                    <x-ui.form.input type="number" wire:model="price" :for="__('price')" required min="0" max="9999999" autocomplete="off" placeholder="{{ __('Price') }}" class="rounded-md" />
                </x-ui.form.label>
                <x-ui.form.label :title="__('Discount')" :for="__('discount')">
                    <x-ui.form.input type="number" wire:model="discount" :for="__('discount')" required min="0" max="100" autocomplete="off" placeholder="{{ __('Discount') }}" class="rounded-md" />
                </x-ui.form.label>
                <x-ui.table class="sm:col-span-4 xs:col-span-2 shadow-none my-4">
                    <x-ui.table.head>
                        <x-ui.table.th :content="__('Quantity (Unit)')" />
                        <x-ui.table.th :content="__('Unit Price')" />
                        <x-ui.table.th :content="__('Discount')" />
                        <x-ui.table.th :content="__('Total')" />
                    </x-ui.table.head>
                    <x-ui.table.body>
                        <x-ui.table.tr>
                            <x-ui.table.td x-text="($wire.quantity ?? 0) +'{{ ' (' . $unit_code . ')' }}'" />
                            <x-ui.table.td x-text="$wire.price ?? 0" />
                            <x-ui.table.td x-text="($wire.discount / 100  * ($wire.price ?? 0)).toFixed(2)" />
                            <x-ui.table.td x-text="(($wire.price ?? 0) - ($wire.discount / 100 * ($wire.price ?? 0))).toFixed(2)" />
                        </x-ui.table.tr>
                    </x-ui.table.body>
                </x-ui.table>
            </div>
        </div>
        <div class="w-full">
            <x-panel.heading :title="__('Product Colors')" class="text-xl border-secondary-500" />
            <livewire:panel.components.color-input :product="$product->ref_id" />
        </div>
        <div class="w-full">
            <x-panel.heading :title="__('Product Available Stock')" class="text-xl border-secondary-500" />
            <div class="grid gap-x-4 md:grid-cols-4 xs:grid-cols-2">
                <x-ui.form.label :title="__('Available Stock')" :for="__('stock')">
                    <x-ui.form.input type="number" wire:model="stock" :for="__('stock')" required min="0" max="9999" autocomplete="off" placeholder="{{ __('Available Stock') }}" class="rounded-md" />
                </x-ui.form.label>
            </div>
        </div>
        <div class="flex justify-end gap-4 mt-2">
            <x-ui.links.outline-link :link="__('red')" wire:navigate href="{{ route('admin.products.add_product.edit_overview', ['product' => $product->ref_id]) }}" :title="__('Go Back')" class="rounded-md" />
            <x-ui.buttons.button type="button" :button="__('green')" wire:click="saveProductPricingAndColors" :title="__('Save & Next')" class="rounded-md" />
        </div>
    </x-ui.card>
</section>
