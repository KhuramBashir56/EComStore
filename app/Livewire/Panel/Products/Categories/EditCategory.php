<?php

namespace App\Livewire\Panel\Products\Categories;

use App\Models\ActivityLog;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditCategory extends Component
{
    use WithFileUploads;

    public $category, $name, $thumbnail, $old_thumbnail, $keywords, $description;

    public function mount($category)
    {
        $this->authorize('admin');
        $category = Category::where('status', '!=', 'deleted')->where('ref_id', $category)->select('id', 'name', 'description', 'keywords', 'thumbnail')->first();
        if ($category) {
            $this->category = $category;
            $this->name = $category->name;
            $this->old_thumbnail = $category->thumbnail;
            $this->keywords = explode(', ', $category->keywords);
            $this->description = $category->description;
        } else {
            $this->dispatch('alert', type: 'warning', message: 'This category already deleted you can not edit it.');
            $this->cancel();
        }
    }

    #[On('keywordInputUpdated')]
    public function getKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    public function updateCategory()
    {
        $this->authorize('admin');
        $this->validate([
            'name' => ['required', 'string', 'max:48', 'unique:' . Category::class . ',name,' . $this->category->id],
            'thumbnail' => ['nullable', 'image', 'mimes:png,jpg,jpeg,svg,webp', 'max:512'],
            'keywords' => ['required', 'array'],
            'description' => ['required', 'string', 'max:155'],
        ]);
        if ($this->category->status !== 'deleted') {
            try {
                DB::transaction(function () {
                    $this->category->name = trim($this->name);
                    $this->category->thumbnail = $this->thumbnail ? $this->thumbnail->store('products/categories', 'public') : $this->old_thumbnail;
                    $this->category->keywords = implode(', ', $this->keywords);
                    $this->category->description = $this->description;
                    $this->category->status = 'unpublished';
                    $this->category->updated_at = now()->format('Y-m-d H:i:s.u');
                    $this->category->save();
                    ActivityLog::activity($this->category->id, 'update', 'Product Category', NULL);
                });
                if ($this->thumbnail) {
                    Storage::disk('public')->delete($this->old_thumbnail);
                }
                $this->dispatch('alert', type: 'success', message: 'Category updated successfully');
                $this->cancel();
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
                $this->cancel();
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'This category already deleted you can not edit it.');
            $this->cancel();
        }
    }

    public function cancel()
    {
        $this->reset(['name', 'thumbnail', 'keywords', 'description']);
        $this->category = null;
        $this->dispatch('resetKeywordInput');
        $this->redirectRoute('admin.products.categories.list', navigate: true);
    }

    #[Layout('components.layouts.panel')]
    public function render()
    {
        return view('livewire.panel.products.categories.edit-category');
    }
}
