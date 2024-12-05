<?php

namespace App\Livewire\Web\Components\Footer;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class BuyerCart extends Component
{
    #[On('updateCartCounter')]
    public function render()
    {
        return view('livewire.web.components.footer.buyer-cart', [
            'cartCount' => Auth::check() ? Auth::user()->cart->where('status', 'active')->count() : 0
        ]);
    }
}
