<?php

namespace App\Livewire\Panel\Products\Categories;

use App\Models\ActivityLog;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddNewCategory extends Component
{
    use WithFileUploads;

    public $name, $thumbnail, $keywords, $description;

    #[On('keywordInputUpdated')]
    public function getKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    public function saveCategory()
    {
        $this->authorize('admin');
        $this->validate([
            'name' => ['required', 'string', 'max:48', 'unique:' . Category::class . ',name'],
            'thumbnail' => ['required', 'image', 'mimes:png,jpg,jpeg,svg,webp', 'max:512'],
            'keywords' => ['required', 'array'],
            'description' => ['required', 'string', 'max:155'],
        ]);
        try {
            DB::transaction(function () {
                $category = new Category;
                $category->ref_id = Category::refId();
                $category->author_id = Auth::user()->id;
                $category->name = trim($this->name);
                $category->thumbnail = $this->thumbnail->store('products/categories', 'public');
                $category->keywords = implode(', ', $this->keywords);
                $category->description = $this->description;
                $category->created_at = now()->format('Y-m-d H:i:s.u');
                $category->save();
                ActivityLog::activity($category->id, 'create', 'Product Category', NULL);
            });
            $this->dispatch('alert', type: 'success', message: 'New category added successfully');
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
        $this->redirectRoute('admin.products.categories.list', navigate: true);
    }

    #[Layout('components.layouts.panel')]
    public function render()
    {
        return view('livewire.panel.products.categories.add-new-category');
    }
}
