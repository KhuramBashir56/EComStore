<?php

namespace App\Livewire\Web\Components\Header;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class BuyerCart extends Component
{
    public $items = [];

    public function loadCartItems()
    {
        if (Auth::check()) {
            if (Auth::user()->cart->where('status', 'active')->count() > 0) {
                $this->items = Auth::user()->cart->where('status', 'active')->get();
            }
        } else {
            $this->dispatch('openLoginModal');
        }
    }

    #[On('updateCartCounter')]
    public function render()
    {
        return view('livewire.web.components.header.buyer-cart', [
            'cartCount' => Auth::check() ? Auth::user()->cart->where('status', 'active')->count() : 0
        ]);
    }
}
