<?php

namespace App\Livewire\Panel\Products\Brands;

use App\Models\ActivityLog;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class BrandDetails extends Component
{
    public $brand;

    public function mount(Brand $brand)
    {
        $this->authorize('admin');
        if ($brand && $brand->status !== 'deleted') {
            $this->brand = $brand->load([
                'categories.category:id,name',
                'categories:id,category_id,name',
            ]);
        } else {
            $this->dispatch('alert', type: 'warning', message: 'This brand already deleted you can not edit it.');
            $this->redirectRoute('admin.products.brands.list', navigate: true);
        }
    }

    public function unPublishBrand()
    {
        $this->authorize('admin');
        if ($this->brand->status === 'published') {
            try {
                DB::transaction(function () {
                    $this->brand->status = 'unpublished';
                    $this->brand->updated_at = now()->format('Y-m-d H:i:s.u');
                    $this->brand->update();
                    ActivityLog::activity($this->brand->id, 'unpublish', 'Product Brand', NULL);
                });
                $this->dispatch('alert', type: 'success', message: 'Brand unpublished successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'This brand already unpublished.');
        }
    }

    public function publishBrand()
    {
        $this->authorize('admin');
        if ($this->brand->status === 'unpublished') {
            try {
                Db::transaction(function () {
                    $this->brand->status = 'published';
                    $this->brand->updated_at = now()->format('Y-m-d H:i:s.u');
                    $this->brand->update();
                    ActivityLog::activity($this->brand->id, 'publish', 'Product Brand', NULL);
                });
                $this->dispatch('alert', type: 'success', message: 'Brand published successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'This brand already published.');
        }
    }

    public function editBrand()
    {
        $this->authorize('admin');
        if ($this->brand->status !== 'deleted') {
            $this->redirectRoute('admin.products.brands.edit', ['brand' => $this->brand->id], navigate: true);
        } else {
            $this->dispatch('alert', type: 'warning', message: 'This brand already deleted you can not edit it.');
        }
    }

    public function deleteBrand()
    {
        $this->authorize('admin');
        if ($this->brand->status !== 'deleted') {
            try {
                DB::transaction(function () {
                    $this->brand->status = 'deleted';
                    $this->brand->updated_at = now()->format('Y-m-d H:i:s.u');
                    $this->brand->update();
                    ActivityLog::activity($this->brand->id, 'delete', 'Product Brand', NULL);
                });
                $this->dispatch('alert', type: 'success', message: 'Brand deleted successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'This brand already deleted.');
        }
    }

    public function removeCategory($category)
    {
        $this->authorize('admin');
        if ($this->brand->status !== 'deleted') {
            try {
                DB::transaction(function () use ($category) {
                    $this->brand->categories()->detach($category);
                    ActivityLog::activity($this->brand->id, 'delete', 'Product Brand', 'Removed Sub Category');
                });
                $this->dispatch('alert', type: 'success', message: 'Category removed successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'This brand already deleted you can not remove category.');
        }
    }


    #[Layout('components.layouts.panel')]
    public function render()
    {
        return view('livewire.panel.products.brands.brand-details');
    }
}
