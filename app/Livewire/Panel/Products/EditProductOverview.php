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

class EditProductOverview extends Component
{
    public $product, $name, $category, $subCategory, $brand, $keywords, $description;

    public $subCategories = [];

    public $brands = [];

    public function mount($product)
    {
        $product = Product::where('status', '!=', 'deleted')->select('id', 'ref_id', 'name', 'category_id', 'sub_category_id', 'brand_id', 'keywords', 'short_description', 'status')->where('ref_id', $product)->first();
        if ($product && $product->status !== 'deleted') {
            $this->product = $product;
            $this->name = $product->name;
            $this->category = $product->category_id;
            $this->subCategory = $product->sub_category_id;
            $this->brand = $product->brand_id;
            $this->keywords = explode(', ', $product->keywords);
            $this->description = $product->short_description;
            $this->subCategories = SubCategory::where('status', 'published')->where('category_id', $this->category)->select('id', 'name')->orderBy('name')->get();
            $this->brands = Brand::where('status', 'published')->whereHas('categories', function ($category) {
                $category->where('sub_categories_brands.category_id', $this->subCategory);
            })->select('id', 'name')->orderBy('name')->get();
        } else {
            $this->redirectRoute('admin.products.list', navigate: true);
            $this->dispatch('alert', type: 'warning', message: 'Record Not Found.');
        }
    }

    public function updatedCategory()
    {
        $this->subCategories = SubCategory::where('status', 'published')->where('category_id', $this->category)->select('id', 'name')->orderBy('name')->get();
        $this->brands = [];
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

    public function updateProductOverview()
    {
        $this->authorize('admin');
        $this->validate([
            'name' => ['required', 'string', 'max:125', 'unique:' . Product::class . ',name,' . $this->product->id],
            'category' => ['required', 'integer', 'exists:' . Category::class . ',id'],
            'subCategory' => ['required', 'integer', 'exists:' . SubCategory::class . ',id'],
            'brand' => ['required', 'integer', 'exists:' . Brand::class . ',id'],
            'keywords' => ['required', 'array'],
            'description' => ['required', 'string', 'max:155'],
        ]);
        if ($this->product->status !== 'deleted') {
            try {
                DB::transaction(function () {
                    $this->product->ref_id = Product::refId();
                    $this->product->author_id = Auth::user()->id;
                    $this->product->name = $this->name;
                    $this->product->category_id = $this->category;
                    $this->product->sub_category_id = $this->subCategory;
                    $this->product->brand_id = $this->brand;
                    $this->product->keywords = implode(', ', $this->keywords);
                    $this->product->short_description = $this->description;
                    $this->product->update();
                    ActivityLog::activity($this->product->id, 'update', 'Product', 'Overview');
                    $this->redirectRoute('admin.products.add_product.pricing_and_colors', ['product' => $this->product->ref_id], navigate: true);
                });
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'This product already deleted you can not update.');
            $this->cancel();
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
        return view('livewire.panel.products.edit-product-overview', [
            'categories' => Category::where('status', 'published')->select('id', 'name')->orderBy('name')->get(),
        ]);
    }
}
