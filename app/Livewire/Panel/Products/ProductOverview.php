<?php

namespace App\Livewire\Panel\Products;

use Livewire\Attributes\Layout;
use Livewire\Component;

class ProductOverview extends Component
{
    #[Layout('components.layouts.panel')]
    public function render()
    {
        return view('livewire.panel.products.product-overview');
    }
}
