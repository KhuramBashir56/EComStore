<?php

namespace App\Livewire\Web\Components\Header;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class BuyerWishlist extends Component
{
    public $items = [];

    public function loadWishlistItems()
    {
        if (Auth::check()) {
            if (Auth::user()->wishlist->where('status', 'active')->count() > 0) {
                $this->items = Auth::user()->wishlist->where('status', 'active')->get();
            }
        } else {
            $this->dispatch('openLoginModal');
        }
    }

    #[On('updateWishlistCounter')]
    public function render()
    {
        return view('livewire.web.components.header.buyer-wishlist', [
            'wishlistCount' => Auth::check() ? Auth::user()->wishlist->where('status', 'active')->count() : 0
        ]);
    }
}
