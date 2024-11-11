<?php

namespace App\Livewire\Panel\Products\Brands;

use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddNewBrand extends Component
{
    use WithFileUploads;

    public $name, $logo, $keywords, $description;

    #[On('keywordInputUpdated')]
    public function getKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    public function saveBrand()
    {
        $this->authorize('admin');
        $this->validate([
            'name' => ['required', 'string', 'max:48', 'unique:' . Brand::class . ',name'],
            'logo' => ['required', 'image', 'mimes:png,jpg,jpeg,svg,webp', 'max:512'],
            'keywords' => ['required', 'array'],
            'description' => ['required', 'string', 'max:155'],
        ]);
        try {
            $brand = new Brand;
            $brand->ref_id = Brand::refId();
            $brand->author_id = Auth::user()->id;
            $brand->name = trim($this->name);
            $brand->logo = $this->logo->store('products/brands', 'public');
            $brand->keywords = implode(', ', $this->keywords);
            $brand->description = $this->description;
            $brand->created_at = now()->format('Y-m-d H:i:s.u');
            $brand->save();
            $this->dispatch('alert', type: 'success', message: 'New brand added successfully');
            $this->cancel();
        } catch (\Throwable $th) {
            $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
        }
    }

    public function cancel()
    {
        $this->reset(['name', 'logo', 'keywords', 'description']);
        $this->dispatch('resetKeywordInput');
        $this->redirectRoute('admin.products.brands.list', navigate: true);
    }

    #[Layout('components.layouts.panel')]
    public function render()
    {
        return view('livewire.panel.products.brands.add-new-brand');
    }
}
