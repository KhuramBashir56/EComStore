<?php

namespace App\Livewire\Panel\Products;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsList extends Component
{
    use WithPagination;

    public $search;

    public $range = 25;

    #[Layout('components.layouts.panel')]
    public function render()
    {
        return view('livewire.panel.products.products-list', [
            'products' => Product::where('status', '!=', 'deleted')->whereAny(['name', 'keywords', 'short_description', 'description', 'thumbnail'], 'LIKE', '%' . $this->search . '%')->paginate($this->range),
        ]);
    }
}
