<x-slot:title>{{ __('Add New Product') }}</x-slot>
<section class="grid gap-4">
    <x-panel.navigation>
        <div class="w-full flex xs:gap-x-2 md:justify-start justify-center items-center">
            <x-ui.form.tab class="{{ $product->ref_id ? 'text-gray-900 dark:text-gray-100' : 'text-gray-400 dark:text-gray-600' }}" :index="1" :title="__('Overview')" :icon="__('keyboard_double_arrow_right')" />
            <x-ui.form.tab class="{{ $product->unit_id ? 'text-gray-900 dark:text-gray-100' : 'text-gray-400 dark:text-gray-600' }}" :index="2" :title="__('Pricing & Colors')" :icon="__('keyboard_double_arrow_right')" />
            <x-ui.form.tab class="text-primary-500 dark:text-secondary-500   " :index="3" :title="__('Description')" :icon="__('keyboard_double_arrow_right')" />
            <x-ui.form.tab class="text-gray-400 dark:text-gray-600" :index="4" :title="__('Gallery')" :icon="__('keyboard_double_arrow_right')" />
            <x-ui.form.tab class="text-gray-400 dark:text-gray-600" :index="5" :title="__('Publish')" />
        </div>
    </x-panel.navigation>
    <x-ui.card class="grid gap-4 rounded-xl">
        <div wire:ignore class="relative">
            <textarea name="description" id="description" wire:model="description"></textarea>
            <span id="counter" class="absolute bottom-[2px] right-4"></span>
        </div>
        @error('description')
            <x-ui.form.input-error :message="$message" />
        @enderror
        @error('text_count')
            <x-ui.form.input-error :message="$message" />
        @enderror
        <div class="flex justify-end gap-4 mx-4 mb-4">
            <x-ui.links.outline-link :link="__('red')" wire:navigate href="{{ route('admin.products.add_product.pricing_and_colors', ['product' => $product->ref_id]) }}" :title="__('Go Back')" class="rounded-md" />
            <x-ui.buttons.button type="button" :button="__('green')" id="saveProductDescription" wire:click="saveProductDescription" :title="__('Save & Next')" class="rounded-md" />
        </div>
    </x-ui.card>
</section>
@assets
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.9.2/ckeditor.js"></script>
@endassets
@script
    <script type="text/javascript">
        const theme = localStorage.getItem('theme') || 'light';
        const themeColor = theme === 'dark' ? '#9ca3af' : '#ffa666';
        CKEDITOR.replace('description', {
            height: 400,
            uiColor: themeColor,
            toolbar: [{
                    name: 'clipboard',
                    items: ['Undo', 'Redo', '-', 'Cut', 'Copy', 'Paste', 'PasteText']
                },
                {
                    name: 'basicstyles',
                    items: ['Bold', 'Italic', 'Strike', 'RemoveFormat']
                },
                {
                    name: 'paragraph',
                    items: ['NumberedList', 'BulletedList', 'Blockquote']
                },
                {
                    name: 'styles',
                    items: ['Format']
                },
                {
                    name: 'insert',
                    items: ['Table', 'HorizontalRule', 'SpecialChar']
                },
                {
                    name: 'links',
                    items: ['Link', 'Unlink']
                },
            ],
            format_tags: 'p;h2;h3;h4;pre',
        });
        CKEDITOR.instances.description.on('change', function() {
            const description = CKEDITOR.instances.description.getData();
            const tempElement = document.createElement('div');
            tempElement.innerHTML = description;
            const plainText = tempElement.textContent || tempElement.innerText || ' ';
            const alphabeticCount = (plainText.match(/[a-zA-Z0-9]/g) || []).length;
            const counter = document.getElementById('counter');
            if (counter) {
                counter.innerHTML = `${alphabeticCount}/5000`;
            }
            window.plainText = plainText;
        });
        document.getElementById('saveProductDescription').addEventListener('click', function() {
            const description = CKEDITOR.instances.description.getData();
            @this.set('description', description);
            @this.set('text_count', (description.match(/[a-zA-Z0-9]/g) || []).join(''));
        });
    </script>
@endscript
