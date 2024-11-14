<?php

namespace App\Livewire\Panel\Products\SubCategories;

use App\Models\ActivityLog;
use App\Models\SubCategory;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class SubCategoriesList extends Component
{
    use WithPagination;

    public $search;

    public $range = 25;

    public function unPublishSubCategory($category)
    {
        $this->authorize('admin');
        $category = SubCategory::where('status', '!=', 'deleted')->where('ref_id', $category)->select('id', 'status')->first();
        if ($category && $category->status === 'published') {
            try {
                DB::transaction(function () use ($category) {
                    $category->status = 'unpublished';
                    $category->updated_at = now()->format('Y-m-d H:i:s.u');
                    $category->update();
                    ActivityLog::activity($category->id, 'unpublish', 'Product Sub Category', NULL);
                });
                $this->dispatch('alert', type: 'success', message: 'Sub Category un-published successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'Record not found.');
        }
    }

    public function publishSubCategory($category)
    {
        $this->authorize('admin');
        $category = SubCategory::where('status', '!=', 'deleted')->where('ref_id', $category)->select('id', 'status')->first();
        if ($category && $category->status === 'unpublished') {
            try {
                DB::transaction(function () use ($category) {
                    $category->status = 'published';
                    $category->updated_at = now()->format('Y-m-d H:i:s.u');
                    $category->update();
                    ActivityLog::activity($category->id, 'publish', 'Product Sub Category', NULL);
                });
                $this->dispatch('alert', type: 'success', message: 'Sub Category published successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'Record not found.');
        }
    }

    public function deleteSubCategory($category)
    {
        $this->authorize('admin');
        $category = SubCategory::where('status', '!=', 'deleted')->where('ref_id', $category)->select('id', 'status')->first();
        if ($category && $category->status !== 'deleted') {
            try {
                DB::transaction(function () use ($category) {
                    $category->status = 'deleted';
                    $category->updated_at = now()->format('Y-m-d H:i:s.u');
                    $category->update();
                    ActivityLog::activity($category->id, 'delete', 'Product Sub Category', NULL);
                });
                $this->dispatch('alert', type: 'success', message: 'Sub Category deleted successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'warning', message: 'Record not found.');
            }
        }
    }

    #[Layout('components.layouts.panel')]
    public function render()
    {
        $this->range = $this->range ?? 25;
        return view('livewire.panel.products.sub-categories.sub-categories-list', [
            'categories' => SubCategory::where('status', '!=', 'deleted')->with(['category:id,name'])->select('id', 'ref_id', 'category_id', 'name', 'thumbnail', 'status')->orderBy('name')->paginate($this->range),
        ]);
    }
}
