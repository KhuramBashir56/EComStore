<?php

namespace App\Livewire\Panel\Products\Categories;

use App\Models\ActivityLog;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CategoryDetails extends Component
{
    public $category;

    public function mount($category)
    {
        $this->authorize('admin');
        $category = Category::where('status', '!=', 'deleted')->where('ref_id', $category)->select('id', 'ref_id', 'name', 'description', 'keywords', 'thumbnail', 'status', 'updated_at')->first();
        if ($category) {
            $this->category = $category;
        } else {
            $this->dispatch('alert', type: 'warning', message: 'Record not found.');
            $this->redirectRoute('admin.products.categories', navigate: true);
        }
    }

    public function unPublishCategory()
    {
        $this->authorize('admin');
        if ($this->category->status === 'published') {
            try {
                DB::transaction(function () {
                    $this->category->status = 'unpublished';
                    $this->category->updated_at = now()->format('Y-m-d H:i:s.u');
                    $this->category->update();
                    ActivityLog::activity($this->category->id, 'unpublish', 'Product Category', NULL);
                });
                $this->dispatch('alert', type: 'success', message: 'Category un-published successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'This category already unpublished.');
        }
    }

    public function publishCategory()
    {
        $this->authorize('admin');
        if ($this->category->status === 'unpublished') {
            try {
                DB::transaction(function () {
                    $this->category->status = 'published';
                    $this->category->updated_at = now()->format('Y-m-d H:i:s.u');
                    $this->category->update();
                    ActivityLog::activity($this->category->id, 'publish', 'Product Category', NULL);
                });
                $this->dispatch('alert', type: 'success', message: 'Category published successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'This category already published.');
        }
    }

    public function deleteCategory()
    {
        $this->authorize('admin');
        if ($this->category->status !== 'deleted') {
            try {
                DB::transaction(function () {
                    $this->category->status = 'deleted';
                    $this->category->updated_at = now()->format('Y-m-d H:i:s.u');
                    $this->category->save();
                    ActivityLog::activity($this->category->id, 'delete', 'Product Category', NULL);
                });
                $this->dispatch('alert', type: 'success', message: 'Category deleted successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'This category already deleted.');
        }
    }

    #[Layout('components.layouts.panel')]
    public function render()
    {
        return view('livewire.panel.products.categories.category-details');
    }
}
