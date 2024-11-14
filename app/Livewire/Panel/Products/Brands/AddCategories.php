<?php

namespace App\Livewire\Panel\Products\Brands;

use App\Models\ActivityLog;
use App\Models\Brand;
use App\Models\SubCategory;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class AddCategories extends Component
{
    public $brand, $search;

    public function mount($brand)
    {
        $this->authorize('admin');
        $brand = Brand::where('status', '!=', 'deleted')->where('ref_id', $brand)->select('id', 'ref_id', 'name','status')->first();
        if ($brand) {
            $this->brand = $brand;
        } else {
            $this->dispatch('alert', type: 'warning', message: 'Record not found.');
            $this->redirectRoute('admin.products.brands.list', navigate: true);
        }
    }

    public function addCategory($category)
    {
        $this->authorize('admin');
        if ($this->brand->status !== 'deleted') {
            $exist_category = $this->brand->categories->where('id', $category)->pluck('id')->first();
            if ($exist_category) {
                $this->dispatch('alert', type: 'warning', message: 'This category already added.');
            } else {
                try {
                    DB::transaction(function () use ($category) {
                        $this->brand->categories()->attach($category);
                        ActivityLog::activity($this->brand->id, 'create', 'Product Brand', 'Assigned Sub Category');
                    });
                    $this->dispatch('alert', type: 'success', message: 'Category added successfully');
                } catch (\Throwable $th) {
                    $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
                }
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'This brand already deleted you can not assign category.');
        }
    }

    #[Layout('components.layouts.panel')]
    public function render()
    {
        return view('livewire.panel.products.brands.add-categories', [
            'categories' => SubCategory::where('status', 'published')->whereDoesntHave('brands', function ($brand) {
                $brand->where('brand_id', $this->brand->id);
            })->whereAny(['name', 'keywords', 'description'], 'LIKE', $this->search . '%')->with(['category:id,name'])->select('id', 'category_id', 'name')->orderBy('name')->get(),
        ]);
    }
}
