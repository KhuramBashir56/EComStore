<?php

namespace App\Livewire\Web\Components\Footer;

use App\Models\Category;
use Livewire\Component;

class Categories extends Component
{
    public function placeholder()
    {
        return <<<HTML
           <div class="w-full divide-y divide-primary-200 dark:divide-gray-600">
                <div class="h-10 bg-primary-700 dark:bg-gray-500 animate-pulse"></div>
                <div class="h-10 bg-primary-700 dark:bg-gray-500 animate-pulse"></div>
                <div class="h-10 bg-primary-700 dark:bg-gray-500 animate-pulse"></div>
                <div class="h-10 bg-primary-700 dark:bg-gray-500 animate-pulse"></div>
                <div class="h-10 bg-primary-700 dark:bg-gray-500 animate-pulse"></div>
                <div class="h-10 bg-primary-700 dark:bg-gray-500 animate-pulse"></div>
                <div class="h-10 bg-primary-700 dark:bg-gray-500 animate-pulse"></div>
                <div class="h-10 bg-primary-700 dark:bg-gray-500 animate-pulse"></div>
            </div>
        HTML;
    }

    public function render()
    {
        return view('livewire.web.components.footer.categories', [
            'categories' => Category::where('status', 'published')->with(['products' => function ($product) {
                $product->where('status', 'published')->select('id', 'category_id');
            }])->select('id', 'ref_id', 'name')->orderBy('name')->get()
        ]);
    }
}
