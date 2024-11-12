<?php

namespace App\Livewire\Panel\Products\SubCategories;

use App\Models\ActivityLog;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddNewSubCategory extends Component
{
    use WithFileUploads;

    public $category, $name, $thumbnail, $keywords, $description;

    #[On('keywordInputUpdated')]
    public function getKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    public function saveSubCategory()
    {
        $this->authorize('admin');
        $this->validate([
            'category' => ['required', 'exists:' . Category::class . ',id'],
            'name' => ['required', 'string', 'max:48', 'unique:' . SubCategory::class . ',name'],
            'thumbnail' => ['required', 'image', 'mimes:png,jpg,jpeg,svg,webp', 'max:512'],
            'keywords' => ['required', 'array'],
            'description' => ['required', 'string', 'max:155'],
        ]);
        try {
            DB::transaction(function () {
                $subCategory = new SubCategory;
                $subCategory->ref_id = SubCategory::refId();
                $subCategory->author_id = Auth::user()->id;
                $subCategory->category_id = $this->category;
                $subCategory->name = trim($this->name);
                $subCategory->thumbnail = $this->thumbnail->store('products/sub_categories', 'public');
                $subCategory->keywords = implode(', ', $this->keywords);
                $subCategory->description = $this->description;
                $subCategory->created_at = now()->format('Y-m-d H:i:s.u');
                $subCategory->save();
                ActivityLog::activity($subCategory->id, 'create', 'Product Sub Category', NULL);
            });
            $this->dispatch('alert', type: 'success', message: 'New sub category added successfully');
            $this->cancel();
        } catch (\Throwable $th) {
            $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            $this->cancel();
        }
    }

    public function cancel()
    {
        $this->reset(['name', 'thumbnail', 'keywords', 'description']);
        $this->dispatch('resetKeywordInput');
        $this->redirectRoute('admin.products.sub_categories.list', navigate: true);
    }

    #[Layout('components.layouts.panel')]
    public function render()
    {
        return view('livewire.panel.products.sub-categories.add-new-sub-category', [
            'categories' => Category::where('status', 'published')->select('id', 'name')->get(),
        ]);
    }
}
