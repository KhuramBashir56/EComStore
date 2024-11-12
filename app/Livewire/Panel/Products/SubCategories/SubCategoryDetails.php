<?php

namespace App\Livewire\Panel\Products\SubCategories;

use Livewire\Attributes\Layout;
use Livewire\Component;

class SubCategoryDetails extends Component
{
    
    #[Layout('components.layouts.panel')]
    public function render()
    {
        return view('livewire.panel.products.sub-categories.sub-category-details');
    }
}
