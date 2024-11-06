<?php

namespace App\Livewire\Web\Home;

use Livewire\Attributes\Layout;
use Livewire\Component;

class HomeIndex extends Component
{
    #[Layout('components.layouts.web')]
    public function render()
    {
        return view('livewire.web.home.home-index');
    }
}
