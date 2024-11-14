<?php

namespace App\Livewire\Panel\Products;

use App\Models\ActivityLog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductOverview extends Component
{
    public $name, $category, $subCategory, $brand, $keywords, $description;

    public $subCategories = [];

    public $brands = [];

    public function updatedCategory()
    {
        $this->subCategories = SubCategory::where('status', 'published')->where('category_id', $this->category)->select('id', 'name')->orderBy('name')->get();
    }

    public function updatedSubCategory()
    {
        $this->brands = Brand::where('status', 'published')->whereHas('categories', function ($category) {
            $category->where('sub_categories_brands.category_id', $this->subCategory);
        })->select('id', 'name')->orderBy('name')->get();
    }

    #[On('keywordInputUpdated')]
    public function getKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    public function saveProductOverview()
    {
        $this->authorize('admin');
        $this->validate([
            'name' => ['required', 'string', 'max:125', 'unique:' . Product::class . ',name'],
            'category' => ['required', 'integer', 'exists:' . Category::class . ',id'],
            'subCategory' => ['required', 'integer', 'exists:' . SubCategory::class . ',id'],
            'brand' => ['required', 'integer', 'exists:' . Brand::class . ',id'],
            'keywords' => ['required', 'array'],
            'short_description' => ['required', 'string', 'max:155'],
        ]);
        try {
            DB::transaction(function () {
                $product = new Product;
                $product->ref_id = Product::refId();
                $product->author_id = Auth::user()->id;
                $product->name = $this->name;
                $product->category_id = $this->category;
                $product->sub_category_id = $this->subCategory;
                $product->brand_id = $this->brand;
                $product->keywords = implode(', ', $this->keywords);
                $product->description = $this->description;
                $product->save();
                ActivityLog::activity($product->id, 'create', 'Product', NULL);
            });
            $this->dispatch('alert', type: 'success', message: 'Product created successfully.');
            $this->cancel();
        } catch (\Throwable $th) {
            $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
        }
    }

    public function cancel()
    {
        $this->dispatch('resetKeywordInput');
        $this->reset(['name', 'category', 'subCategory', 'brand', 'keywords', 'description']);
        $this->redirectRoute('admin.products.list', navigate: true);
        $this->subCategories = [];
        $this->brands = [];
    }

    #[Layout('components.layouts.panel')]
    public function render()
    {
        return view('livewire.panel.products.product-overview', [
            'categories' => Category::where('status', 'published')->select('id', 'name')->orderBy('name')->get(),

        ]);
    }
}
