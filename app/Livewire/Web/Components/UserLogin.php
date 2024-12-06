<?php

namespace App\Livewire\Web\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserLogin extends Component
{
    public $user_email, $user_password, $remember_me;

    public function close()
    {
        $this->dispatch('closeLoginModal');
        $this->reset(['user_email', 'user_password', 'remember_me']);
    }

    public function login()
    {
        $this->validate([
            'user_email' => ['required', 'email', 'min:8', 'max:64', 'exists:users,email'],
            'user_password' => ['required', 'min:8', 'max:24'],
        ]);
        if (Auth::attempt(['email' => $this->user_email, 'password' => $this->user_password], $this->remember_me)) {
            $this->dispatch('alert', type: 'success', message: 'Login Successful');
            $this->dispatch('updateCartCounter');
            $this->dispatch('updateWishlistCounter');
            $this->dispatch('userLogin');
            $this->close();
        } else {
            $this->dispatch('alert', type: 'error', message: 'Login Failed. Please try again with your correct credentials.');
            $this->reset(['user_email', 'user_password', 'remember_me']);
        }
    }

    public function render()
    {
        return view('livewire.web.components.user-login');
    }
}
