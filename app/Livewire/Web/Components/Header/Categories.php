<?php

namespace App\Livewire\Web\Components\Header;

use App\Models\Category;
use Livewire\Component;

class Categories extends Component
{
    public $categories = [];

    public function getCategories()
    {
        if (empty($this->categories)) {
            $this->categories = Category::where('status', 'published')->select('id', 'ref_id', 'name')->orderBy('name')->get();
        } else {
            $this->categories = $this->categories;
        }
    }

    public function render()
    {
        return view('livewire.web.components.header.categories');
    }
}
