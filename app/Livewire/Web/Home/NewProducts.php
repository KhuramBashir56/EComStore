<?php

namespace App\Livewire\Web\Home;

use App\Models\Product;
use Livewire\Component;

class NewProducts extends Component
{
    public function render()
    {
        return view('livewire.web.home.new-products', [
            'products' => Product::where('status', 'published')->inRandomOrder()->take(14)->select('id', 'ref_id', 'name', 'price', 'discount', 'type', 'ratings', 'thumbnail')->get()
        ]);
    }
}
