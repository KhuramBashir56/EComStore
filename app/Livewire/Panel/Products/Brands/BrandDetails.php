<?php

namespace App\Livewire\Panel\Products\Brands;

use App\Models\Brand;
use Livewire\Attributes\Layout;
use Livewire\Component;

class BrandDetails extends Component
{
    public $brand;

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
            }
        }
    }

    public function editBrand()
    {
        $this->authorize('admin');
        if ($this->brand->status === 'deleted') {
            $this->dispatch('alert', type: 'warning', message: 'This brand already deleted you can not edit it.');
        } else {
            $this->redirectRoute('admin.products.brands.edit', ['brand' => $this->brand->id], navigate: true);
        }
    }

    public function unpublishBrand()
    {
        $this->authorize('admin');
        if ($this->brand->status === 'unpublished' && $this->brand->status === 'deleted') {
            $this->dispatch('alert', type: 'warning', message: 'This brand already unpublished.');
        } else {
            try {
                $this->brand->status = 'unpublished';
                $this->brand->updated_at = now()->format('Y-m-d H:i:s.u');
                $this->brand->update();
                $this->dispatch('alert', type: 'success', message: 'Brand unpublished successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        }
    }

    public function publishBrand()
    {
        $this->authorize('admin');
        if ($this->brand->status === 'published' && $this->brand->status === 'deleted') {
            $this->dispatch('alert', type: 'warning', message: 'This brand already published.');
        } else {
            try {
                $this->brand->status = 'published';
                $this->brand->updated_at = now()->format('Y-m-d H:i:s.u');
                $this->brand->update();
                $this->dispatch('alert', type: 'success', message: 'Brand published successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        }
    }

    public function deleteBrand()
    {
        $this->authorize('admin');
        if ($this->brand->status === 'deleted') {
            $this->dispatch('alert', type: 'warning', message: 'This brand already deleted.');
        } else {
            try {
                $this->brand->status = 'deleted';
                $this->brand->updated_at = now()->format('Y-m-d H:i:s.u');
                $this->brand->update();
                $this->dispatch('alert', type: 'success', message: 'Brand deleted successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        }
    }

    #[Layout('components.layouts.panel')]
    public function render()
    {
        return view('livewire.panel.products.brands.brand-details');
    }
}
