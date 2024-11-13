<?php

namespace App\Livewire\Panel\Products\Categories;

use App\Models\ActivityLog;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class CategoriesList extends Component
{
    use WithPagination;

    public $search;

    public $range = 25;

    public function unPublishCategory(Category $category)
    {
        $this->authorize('admin');
        if ($category && $category->status === 'published') {
            try {
                DB::transaction(function () use ($category) {
                    $category->status = 'unpublished';
                    $category->updated_at = now()->format('Y-m-d H:i:s.u');
                    $category->update();
                    ActivityLog::activity($category->id, 'unpublish', 'Product Category', NULL);
                });
                $this->dispatch('alert', type: 'success', message: 'Category un-published successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'This category already unpublished.');
        }
    }

    public function publishCategory(Category $category)
    {
        $this->authorize('admin');
        if ($category && $category->status === 'unpublished') {
            try {
                DB::transaction(function () use ($category) {
                    $category->status = 'published';
                    $category->updated_at = now()->format('Y-m-d H:i:s.u');
                    $category->update();
                    ActivityLog::activity($category->id, 'publish', 'Product Category', NULL);
                });
                $this->dispatch('alert', type: 'success', message: 'Category published successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'This category already published.');
        }
    }

    public function viewCategory(Category $category)
    {
        $this->authorize('admin');
        if ($category && $category->status !== 'deleted') {
            $this->redirectRoute('admin.products.categories.details', ['category' => $category->id], navigate: true);
        } else {
            $this->dispatch('alert', type: 'warning', message: 'This category already deleted.');
        }
    }

    public function editCategory(Category $category)
    {
        $this->authorize('admin');
        if ($category && $category->status !== 'deleted') {
            $this->redirectRoute('admin.products.categories.edit', ['category' => $category->id], navigate: true);
        } else {
            $this->dispatch('alert', type: 'warning', message: 'This category already deleted.');
        }
    }

    public function deleteCategory(Category $category)
    {
        $this->authorize('admin');
        if ($category && $category->status !== 'deleted') {
            try {
                DB::transaction(function () use ($category) {
                    $category->status = 'deleted';
                    $category->updated_at = now()->format('Y-m-d H:i:s.u');
                    $category->update();
                    ActivityLog::activity($category->id, 'delete', 'Product Category', NULL);
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
        $this->range = $this->range ?? 25;
        return view('livewire.panel.products.categories.categories-list', [
            'categories' => Category::where('status', '!=', 'deleted')->whereAny(['name', 'keywords', 'description'], 'LIKE', $this->search . '%')->select('id', 'name', 'thumbnail', 'status')->orderBy('name')->paginate($this->range)
        ]);
    }
}
