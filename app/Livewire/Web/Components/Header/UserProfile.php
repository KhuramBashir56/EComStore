<?php

namespace App\Livewire\Web\Components\Header;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class UserProfile extends Component
{
    public function userProfile()
    {
        if (!Auth::check()) {
            $this->dispatch('openLoginModal');
        }
    }

    #[On('userLogin')]
    public function render()
    {
        return view('livewire.web.components.header.user-profile');
    }
}
