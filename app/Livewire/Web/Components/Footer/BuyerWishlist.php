<?php

namespace App\Livewire\Web\Components\Footer;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class BuyerWishlist extends Component
{
    #[On('updateWishlistCounter')]
    public function render()
    {
        return view('livewire.web.components.footer.buyer-wishlist', [
            'wishlistCount' => Auth::check() ? Auth::user()->wishlist->where('status', 'active')->count() : 0
        ]);
    }
}
