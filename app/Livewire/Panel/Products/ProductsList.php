<?php

namespace App\Livewire\Panel\Products;

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
        return view('livewire.panel.products.products-list');
    }
}
