<?php

namespace App\Livewire\Web\Home;

use App\Models\Brand;
use Livewire\Component;

class TopBrands extends Component
{
    public function render()
    {
        return view('livewire.web.home.top-brands', [
            'brands' => Brand::where('status', 'published')->with(['products' => function ($products) {
                $products->where('status', 'published')->select('id', 'brand_id');
            }])->inRandomOrder()->take(12)->select('id', 'ref_id', 'name', 'logo')->get(),
        ]);
    }
}
