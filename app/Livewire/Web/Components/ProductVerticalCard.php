<?php

namespace App\Livewire\Web\Components;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductVerticalCard extends Component
{
    public $product;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function addToCart($product)
    {
        if (Auth::check()) {
            $this->authorize('buyer');
            $product = Product::where('ref_id', $product)->where('status', 'published')->first();
            if ($product) {
                $product = Cart::addToCart($product->id);
                $this->dispatch('updateCartCounter');
                $this->dispatch('alert', type: $product['status'], message: $product['message']);
            } else {
                $this->dispatch('alert', type: 'warning', message: 'Record not found.');
            }
        } else {
            $this->dispatch('openLoginModal');
        }
    }

    public function addToWishlist($product)
    {
        if (Auth::check()) {
            $this->authorize('buyer');
            $product = Product::where('ref_id', $product)->where('status', 'published')->first();
            if ($product) {
                $product = Wishlist::addToWishlist($product->id);
                $this->dispatch('updateWishlistCounter');
                $this->dispatch('alert', type: $product['status'], message: $product['message']);
            } else {
                $this->dispatch('alert', type: 'warning', message: 'Record not found.');
            }
        } else {
            $this->dispatch('openLoginModal');
        }
    }

    public function placeholder()
    {
        return <<<HTML
            <article class="w-full bg-white dark:bg-gray-800 rounded-md shadow-md group animate-pulse">
                <div class="w-full aspect-square rounded-t-md bg-gray-300 dark:bg-gray-700 flex justify-center items-center">
                    <span class="material-symbols-outlined text-8xl text-white">photo</span>
                </div>
                <div class="flex flex-col gap-2 py-2 px-3 relative overflow-hidden">
                    <div class="bg-gray-300 dark:bg-gray-700 h-5 w-full"></div>
                    <div class="bg-gray-300 dark:bg-gray-700 h-5 w-full"></div>
                    <div class="bg-gray-300 dark:bg-gray-700 h-5 w-full"></div>
                </div>
            </article>
        HTML;
    }

    public function render()
    {
        return view('livewire.web.components.product-vertical-card');
    }
}
