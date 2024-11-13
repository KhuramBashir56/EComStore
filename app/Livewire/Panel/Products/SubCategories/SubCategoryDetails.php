<?php

namespace App\Livewire\Panel\Products\SubCategories;

use App\Models\ActivityLog;
use App\Models\SubCategory;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class SubCategoryDetails extends Component
{
    public $category;

    public function mount(SubCategory $category)
    {
        $this->authorize('admin');
        if ($category && $category->status !== 'deleted') {
            $this->category = $category->load([
                'category:id,name',
                'brands:id,name',
            ]);
        } else {
            $this->dispatch('alert', type: 'warning', message: 'This sub category already deleted you can not edit it.');
            $this->redirectRoute('admin.products.sub_categories.list', navigate: true);
        }
    }

    public function removeBrand($brand)
    {
        $this->authorize('admin');
        if ($this->category->status !== 'deleted') {
            try {
                DB::transaction(function () use ($brand) {
                    $this->category->brands()->detach($brand);
                    ActivityLog::activity($this->category->id, 'delete', 'Product Sub Category', 'Removed Brand');
                });
            } catch (\Throwable $th) {
                $this->dispatch('error', type: 'error', message: 'Something went wrong please try again.');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'This sub category already deleted you can not remove this brand brand.');
        }
    }

    #[Layout('components.layouts.panel')]
    public function render()
    {
        return view('livewire.panel.products.sub-categories.sub-category-details');
    }
}
