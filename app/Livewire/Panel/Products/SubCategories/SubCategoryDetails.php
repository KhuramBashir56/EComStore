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

    public function mount($category)
    {
        $this->authorize('admin');
        $category = SubCategory::where('status', '!=', 'deleted')->where('ref_id', $category)->with([
            'category:id,name',
            'brands:id,name',
        ])->select('id', 'ref_id', 'category_id', 'name', 'thumbnail', 'keywords', 'description', 'status', 'updated_at')->first();
        if ($category && $category->status !== 'deleted') {
            $this->category = $category;
        } else {
            $this->dispatch('alert', type: 'warning', message: 'Record not found.');
            $this->redirectRoute('admin.products.sub_categories.list', navigate: true);
        }
    }

    public function unPublishSubCategory()
    {
        $this->authorize('admin');
        if ($this->category->status === 'published') {
            try {
                DB::transaction(function () {
                    $this->category->update(['status' => 'unpublished']);
                    ActivityLog::activity($this->category->id, 'unpublish', 'Product Sub Category', NULL);
                });
                $this->dispatch('alert', type: 'success', message: 'Sub Category un-published successfully');
            } catch (\Throwable $th) {
                $this->dispatch('error', type: 'error', message: 'Something went wrong please try again.');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'Record not found.');
        }
    }

    public function publishSubCategory()
    {
        $this->authorize('admin');
        if ($this->category->status === 'unpublished') {
            try {
                DB::transaction(function () {
                    $this->category->update(['status' => 'published']);
                    ActivityLog::activity($this->category->id, 'publish', 'Product Sub Category', NULL);
                });
                $this->dispatch('alert', type: 'success', message: 'Sub Category published successfully');
            } catch (\Throwable $th) {
                $this->dispatch('error', type: 'error', message: 'Something went wrong please try again.');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'Record not found.');
        }
    }

    public function deleteSubCategory()
    {
        $this->authorize('admin');
        if ($this->category->status !== 'deleted') {
            try {
                DB::transaction(function () {
                    $this->category->update(['status' => 'deleted']);
                    ActivityLog::activity($this->category->id, 'delete', 'Product Sub Category', NULL);
                });
                $this->dispatch('alert', type: 'success', message: 'Sub Category deleted successfully');
                $this->redirectRoute('admin.products.sub_categories.list', navigate: true);
            } catch (\Throwable $th) {
                $this->dispatch('error', type: 'error', message: 'Something went wrong please try again.');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'Record not found.');
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
                $this->dispatch('alert', type: 'success', message: 'Brand removed successfully');
            } catch (\Throwable $th) {
                $this->dispatch('error', type: 'error', message: 'Something went wrong please try again.');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'Record not found.');
        }
    }

    #[Layout('components.layouts.panel')]
    public function render()
    {
        return view('livewire.panel.products.sub-categories.sub-category-details');
    }
}
