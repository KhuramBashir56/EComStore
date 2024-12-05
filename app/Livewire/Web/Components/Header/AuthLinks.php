<?php

namespace App\Livewire\Web\Components\Header;

use Livewire\Attributes\On;
use Livewire\Component;

class AuthLinks extends Component
{
    #[On('userLogin')]
    public function render()
    {
        return view('livewire.web.components.header.auth-links');
    }
}
