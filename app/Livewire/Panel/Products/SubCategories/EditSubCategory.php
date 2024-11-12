<?php

namespace App\Livewire\Panel\Products\SubCategories;

use App\Models\ActivityLog;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditSubCategory extends Component
{
    use WithFileUploads;

    public $subCategory, $category, $name, $thumbnail, $old_thumbnail, $keywords, $description;

    public function mount(SubCategory $category)
    {
        $this->authorize('admin');
        if ($category && $category->status !== 'deleted') {
            $this->subCategory = $category;
            $this->category = $category->category->id;
            $this->name = $category->name;
            $this->old_thumbnail = $category->thumbnail;
            $this->keywords = explode(', ', $category->keywords);
            $this->description = $category->description;
        } else {
            $this->dispatch('alert', type: 'warning', message: 'This sub category already deleted you can not edit it.');
            $this->cancel();
        }
    }

    #[On('keywordInputUpdated')]
    public function getKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    public function updateSubCategory()
    {
        $this->authorize('admin');
        $this->validate([
            'category' => ['required', 'exists:' . Category::class . ',id'],
            'name' => ['required', 'string', 'max:48', 'unique:' . SubCategory::class . ',name,' . $this->subCategory->id],
            'thumbnail' => ['nullable', 'image', 'mimes:png,jpg,jpeg,svg,webp', 'max:512'],
            'keywords' => ['required', 'array'],
            'description' => ['required', 'string', 'max:155'],
        ]);
        if ($this->subCategory->status !== 'deleted') {
            try {
                DB::transaction(function () {
                    $this->subCategory->category_id = $this->category;
                    $this->subCategory->name = $this->name;
                    $this->subCategory->thumbnail = $this->thumbnail ? $this->thumbnail->store('products/sub_categories', 'public') : $this->old_thumbnail;
                    $this->subCategory->keywords = implode(', ', $this->keywords);
                    $this->subCategory->description = $this->description;
                    $this->subCategory->update();
                    ActivityLog::activity($this->subCategory->id, 'update', 'Product Sub Category', NULL);
                });
                if ($this->thumbnail) {
                    Storage::disk('public')->delete($this->old_thumbnail);
                }
                $this->dispatch('alert', type: 'success', message: 'Sub category updated successfully.');
                $this->cancel();
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
                $this->cancel();
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'This sub category already deleted you can not edit it.');
            $this->cancel();
        }
    }

    public function cancel()
    {
        $this->reset(['category', 'name', 'thumbnail', 'old_thumbnail', 'keywords', 'description']);
        $this->subCategory = null;
        $this->dispatch('resetKeywordInput');
        $this->redirectRoute('admin.products.sub_categories.list', navigate: true);
    }

    #[Layout('components.layouts.panel')]
    public function render()
    {
        return view('livewire.panel.products.sub-categories.edit-sub-category', [
            'categories' => Category::where('status', 'published')->select('id', 'name')->get(),
        ]);
    }
}
