<?php

namespace App\Livewire\Panel\Products;

use App\Models\ActivityLog;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Details extends Component
{

    public function unPublishProduct(Product $product)
    {
        if ($product->status == 'published') {
            try {
                DB::transaction(function () use ($product) {
                    $product->status = 'unpublished';
                    $product->update();
                    ActivityLog::activity($product->id, 'update', 'Product', 'unpublished');
                });
                $this->dispatch('alert', type: 'success', message: 'Product has been unpublished.');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'Record not found.');
        }
    }

    public function publishProduct(Product $product)
    {
        if ($product->status == 'unpublished') {
            try {
                DB::transaction(function () use ($product) {
                    $product->status = 'published';
                    $product->update();
                    ActivityLog::activity($product->id, 'update', 'Product', 'published');
                });
                $this->dispatch('alert', type: 'success', message: 'Product has been published.');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'Record not found.');
        }
    }

    public function deleteProduct(Product $product)
    {
        if ($product->status !== 'deleted') {
            try {
                DB::transaction(function () use ($product) {
                    $product->status = 'deleted';
                    $product->update();
                    ActivityLog::activity($product->id, 'delete', 'Product', NULL);
                });
                $this->dispatch('alert', type: 'success', message: 'Product has been deleted.');
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
        return view('livewire.panel.products.details');
    }
}
