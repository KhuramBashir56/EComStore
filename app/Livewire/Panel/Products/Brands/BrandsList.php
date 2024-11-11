<?php

namespace App\Livewire\Panel\Products\Brands;

use App\Models\Brand;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class BrandsList extends Component
{
    use WithPagination;

    public $search;

    public $range = 25;

    protected $listeners = ['unPublishBrand' => 'unPublishBrand'];

    public function unPublishBrand(Brand $brand)
    {
        $this->authorize('admin');
        if ($brand->status === 'unpublished' && $brand->status === 'deleted') {
            $this->dispatch('alert', type: 'warning', message: 'This brand already unpublished.');
        } else {
            try {
                $brand->status = 'unpublished';
                $brand->updated_at = now()->format('Y-m-d H:i:s.u');
                $brand->update();
                $this->dispatch('alert', type: 'success', message: 'Brand unpublished successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        }
    }

    public function publishBrand(Brand $brand)
    {
        $this->authorize('admin');
        if ($brand->status === 'published' && $brand->status === 'deleted') {
            $this->dispatch('alert', type: 'warning', message: 'This brand already published.');
        } else {
            try {
                $brand->status = 'published';
                $brand->updated_at = now()->format('Y-m-d H:i:s.u');
                $brand->update();
                $this->dispatch('alert', type: 'success', message: 'Brand published successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        }
    }

    public function deleteBrand(Brand $brand)
    {
        $this->authorize('admin');
        if ($brand->status === 'deleted') {
            $this->dispatch('alert', type: 'warning', message: 'This brand already deleted.');
        } else {
            try {
                $brand->status = 'deleted';
                $brand->updated_at = now()->format('Y-m-d H:i:s.u');
                $brand->update();
                $this->dispatch('alert', type: 'success', message: 'Brand deleted successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        }
    }

    public function viewBrand(Brand $brand)
    {
        $this->authorize('admin');
        if ($brand->status === 'deleted') {
            $this->dispatch('alert', type: 'warning', message: 'This brand already deleted you cannot view it.');
        } else {
            $this->redirectRoute('admin.products.brands.details', ['brand' => $brand->id], navigate: true);
        }
    }

    public function editBrand(Brand $brand)
    {
        $this->authorize('admin');
        if ($brand->status === 'deleted') {
            $this->dispatch('alert', type: 'warning', message: 'This brand already deleted you cannot edit it.');
        } else {
            $this->redirectRoute('admin.products.brands.edit', ['brand' => $brand->id], navigate: true);
        }
    }

    #[Layout('components.layouts.panel')]
    public function render()
    {
        if (empty($this->range)) {
            $this->range = 25;
        }
        return view('livewire.panel.products.brands.brands-list', [
            'brands' => Brand::where('status', '!=', 'deleted')->whereAny(['name', 'keywords', 'description'], 'LIKE', $this->search . '%')->select('id', 'name', 'logo', 'status')->orderBy('name')->paginate($this->range),
        ]);
    }
}
