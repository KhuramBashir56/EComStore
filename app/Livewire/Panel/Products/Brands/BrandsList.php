<?php

namespace App\Livewire\Panel\Products\Brands;

use App\Models\ActivityLog;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class BrandsList extends Component
{
    use WithPagination;

    public $search;

    public $range = 25;

    public function unPublishBrand($brand)
    {
        $this->authorize('admin');
        $brand = Brand::where('status', '!=', 'deleted')->where('ref_id', $brand)->select('id', 'status')->first();
        if ($brand && $brand->status === 'published') {
            try {
                DB::transaction(function () use ($brand) {
                    $brand->status = 'unpublished';
                    $brand->updated_at = now()->format('Y-m-d H:i:s.u');
                    $brand->update();
                    ActivityLog::activity($brand->id, 'unpublish', 'Product Brand', NULL);
                });
                $this->dispatch('alert', type: 'success', message: 'Brand unpublished successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'Record not found.');
        }
    }

    public function publishBrand($brand)
    {
        $this->authorize('admin');
        $brand = Brand::where('status', '!=', 'deleted')->where('ref_id', $brand)->select('id', 'status')->first();
        if ($brand && $brand->status === 'unpublished') {
            try {
                DB::transaction(function () use ($brand) {
                    $brand->status = 'published';
                    $brand->updated_at = now()->format('Y-m-d H:i:s.u');
                    $brand->update();
                    ActivityLog::activity($brand->id, 'publish', 'Product Brand', NULL);
                });
                $this->dispatch('alert', type: 'success', message: 'Brand published successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'Record not found.');
        }
    }

    public function deleteBrand($brand)
    {
        $this->authorize('admin');
        $brand = Brand::where('status', '!=', 'deleted')->where('ref_id', $brand)->select('id', 'status')->first();
        if ($brand && $brand->status !== 'deleted') {
            try {
                DB::transaction(function () use ($brand) {
                    $brand->status = 'deleted';
                    $brand->updated_at = now()->format('Y-m-d H:i:s.u');
                    $brand->update();
                    ActivityLog::activity($brand->id, 'delete', 'Product Brand', NULL);
                });
                $this->dispatch('alert', type: 'success', message: 'Brand deleted successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'Record not found.');
        }
    }

    #[Layout('components.layouts.panel')]
    public function render()
    {
        $this->range = $this->range ?? 25;
        return view('livewire.panel.products.brands.brands-list', [
            'brands' => Brand::where('status', '!=', 'deleted')->whereAny(['name', 'keywords', 'description'], 'LIKE', $this->search . '%')->select('id', 'ref_id', 'name', 'logo', 'status')->orderBy('name')->paginate($this->range),
        ]);
    }
}
