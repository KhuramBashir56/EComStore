<?php

namespace App\Livewire\Panel\Products;

use App\Models\Product;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class PricingAndColors extends Component
{
    public $product, $unit, $unit_code, $quantity, $stock, $discount, $price;

    public function mount($product)
    {
        $product = Product::where('ref_id', $product)->select('id', 'ref_id', 'unit_id', 'quantity', 'price', 'discount', 'stock', 'status')->first();
        if ($product && $product->status !== 'deleted') {
            if ($product->ref_id === NULL) {
                $this->redirectRoute('admin.products.add_product.overview', navigate: true);
            } else {
                $this->product = $product;
                $this->unit = $product->unit_id;
                $this->quantity = $product->quantity;
                $this->price = $product->price;
                $this->stock = $product->stock;
                $this->discount = $product->discount;
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'Record Not Found.');
            $this->redirectRoute('admin.products.list', navigate: true);
        }
    }

    public function saveProductPricingAndColors()
    {
        $this->authorize('admin');
        $this->validate([
            'quantity' => ['required', 'numeric', 'min:1', 'max:9999'],
            'unit' => ['required', 'numeric', 'exists:' . Unit::class . ',id'],
            'price' => ['required', 'numeric', 'min:0', 'max:9999999'],
            'discount' => ['required', 'numeric', 'min:0', 'max:100'],
            'stock' => ['required', 'numeric', 'min:0', 'max:9999'],
        ]);
        if ($this->product->status !== 'deleted') {
            try {
                DB::transaction(function () {
                    $product = $this->product;
                    $product->quantity = $this->quantity;
                    $product->unit_id = $this->unit;
                    $product->price = $this->price;
                    $product->discount = $this->discount;
                    $product->stock = $this->stock;
                    $product->update();
                });
                $this->redirectRoute('admin.products.add_product.content_and_description', ['product' => $this->product->ref_id], navigate: true);
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'This product already deleted you can not update.');
        }
    }

    #[Layout('components.layouts.panel')]
    public function render()
    {
        $this->unit_code = $this->unit ? Unit::find($this->unit)->code : 'N/A';
        return view('livewire.panel.products.pricing-and-colors', [
            'units' => Unit::where('status', 'published')->select('id', 'name', 'code')->orderBy('name')->get(),
        ]);
    }
}
