<?php

namespace App\Livewire\Panel\Products\SubCategories;

use App\Models\ActivityLog;
use App\Models\Brand;
use App\Models\SubCategory;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class AddBrands extends Component
{
    public $category, $search;

    public function mount($category)
    {
        $this->authorize('admin');
        $category = SubCategory::where('status', '!=', 'deleted')->where('ref_id', $category)->select('id', 'ref_id', 'category_id', 'status')->first();
        if ($category && $category->status !== 'deleted') {
            $this->category = $category;
        } else {
            $this->dispatch('alert', type: 'warning', message: 'Record not found.');
            $this->redirectRoute('admin.products.sub_categories.list', navigate: true);
        }
    }

    public function addBrand($brand)
    {
        $this->authorize('admin');
        if ($this->category->status !== 'deleted') {
            $exist_brand = $this->category->brands()->where('brand_id', $brand)->first();
            if ($exist_brand) {
                $this->dispatch('alert', type: 'warning', message: 'This brand already added.');
            } else {
                try {
                    DB::transaction(function () use ($brand) {
                        $this->category->brands()->attach($brand);
                        ActivityLog::activity($this->category->id, 'create', 'Product Sub Category', 'Assigned Brand');
                    });
                    $this->dispatch('alert', type: 'success', message: 'Brand added successfully');
                } catch (\Throwable $th) {
                    $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
                }
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'This sub category already deleted you can not assign brand.');
        }
    }

    #[Layout('components.layouts.panel')]
    public function render()
    {
        return view('livewire.panel.products.sub-categories.add-brands', [
            'brands' => Brand::where('status', 'published')->whereDoesntHave('categories', function ($category) {
                $category->where('sub_categories_brands.category_id', $this->category->id);
            })->whereAny(['name', 'keywords', 'description'], 'LIKE', $this->search . '%')->select('id', 'name')->orderBy('name')->get(),
        ]);
    }
}
