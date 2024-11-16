<?php

namespace App\Livewire\Panel\Products;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;

class PricingAndColors extends Component
{
    public $product, $unit, $quantity, $stock, $price, $discount;

    public function mount($product)
    {
        $product = Product::where('ref_id', $product)->select('id', 'ref_id', 'status')->first();
        if ($product && $product->status !== 'deleted') {
            $this->product = $product;
        } else {
            $this->dispatch('alert', type: 'warning', message: 'Record Not Found.');
            $this->redirectRoute('admin.products.list', navigate: true);
        }
    }

    #[Layout('components.layouts.panel')]
    public function render()
    {
        return view('livewire.panel.products.pricing-and-colors');
    }
}
