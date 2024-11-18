<?php

namespace App\Livewire\Panel\Products;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Gallery extends Component
{
    public $product;

    public function mount($product)
    {
        $product = Product::where('ref_id', $product)->select('id', 'ref_id', 'unit_id', 'content', 'status')->first();
        if ($product && $product->status !== 'deleted') {
            if ($product->unit_id === NULL) {
                $this->redirectRoute('admin.products.add_product.pricing_and_colors', ['product' => $product->ref_id], navigate: true);
            } else {
                $this->product = $product;
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'Record Not Found.');
            $this->redirectRoute('admin.products.list', navigate: true);
        }
    }

    #[Layout('components.layouts.panel')]
    public function render()
    {
        return view('livewire.panel.products.gallery');
    }
}
