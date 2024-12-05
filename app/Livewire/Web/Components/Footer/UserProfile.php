<?php

namespace App\Livewire\Web\Components\Footer;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserProfile extends Component
{
    public function userProfile()
    {
        if (Auth::check()) {
            $this->redirectRoute('dashboard', navigate: true);
        } else {
            $this->dispatch('openLoginModal');
        }
    }
    public function render()
    {
        return view('livewire.web.components.footer.user-profile');
    }
}
