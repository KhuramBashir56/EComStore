<?php

namespace App\Livewire\Panel\Products\Brands;

use App\Models\Brand;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditBrand extends Component
{
    use WithFileUploads;

    public $brand, $name, $logo, $old_logo, $keywords, $description;

    public function mount(Brand $brand)
    {
        $this->authorize('admin');
        if (empty($brand)) {
            $this->dispatch('alert', type: 'warning', message: 'Brand not found');
            $this->cancel();
        } else {
            if ($brand->status === 'deleted') {
                $this->dispatch('alert', type: 'warning', message: 'This brand already deleted you can not edit it.');
                $this->cancel();
            } else {
                $this->brand = $brand;
                $this->name = $brand->name;
                $this->old_logo = $brand->logo;
                $this->keywords = explode(', ', $brand->keywords);
                $this->description = $brand->description;
            }
        }
    }

    #[On('keywordInputUpdated')]
    public function getKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    public function updateBrand()
    {
        $this->authorize('admin');
        $this->validate([
            'name' => ['required', 'string', 'max:48', 'unique:' . Brand::class . ',name,' . $this->brand->id],
            'logo' => ['nullable', 'image', 'mimes:png,jpg,jpeg,svg,webp', 'max:512'],
            'keywords' => ['required', 'array'],
            'description' => ['required', 'string', 'max:155'],
        ]);
        try {
            $this->brand->name = trim($this->name);
            $this->brand->logo = $this->logo ? $this->logo->store('products/brands', 'public') : $this->old_logo;
            $this->brand->keywords = implode(', ', $this->keywords);
            $this->brand->description = $this->description;
            $this->brand->status = 'unpublished';
            $this->brand->updated_at = now()->format('Y-m-d H:i:s.u');
            $this->brand->update();
            $this->dispatch('alert', type: 'success', message: 'New brand added successfully');
            if (!empty($this->logo)) {
                Storage::disk('public')->delete($this->old_logo);
            }
            $this->cancel();
        } catch (\Throwable $th) {
            $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            $this->cancel();
        }
    }

    public function cancel()
    {
        $this->reset(['name', 'logo', 'keywords', 'description']);
        $this->brand = null;
        $this->dispatch('resetKeywordInput');
        $this->redirectRoute('admin.products.brands.list', navigate: true);
    }

    #[Layout('components.layouts.panel')]
    public function render()
    {
        return view('livewire.panel.products.brands.edit-brand');
    }
}
