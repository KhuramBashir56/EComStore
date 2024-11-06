<?php

namespace App\Livewire\Web\Components\Footer;

use Livewire\Component;

class PaymentMethods extends Component
{
    public function placeholder()
    {
        return <<<HTML
            <div class="flex flex-wrap gap-4 items-center md:justify-start justify-center">
                <x-thumbnail alt="Payment Method" class="h-10 aspect-video" />
                <x-thumbnail alt="Payment Method" class="h-10 aspect-video" />
                <x-thumbnail alt="Payment Method" class="h-10 aspect-video" />
                <x-thumbnail alt="Payment Method" class="h-10 aspect-video" />
                <x-thumbnail alt="Payment Method" class="h-10 aspect-video" />
            </div>
        HTML;
    }

    public function render()
    {
        return view('livewire.web.components.footer.payment-methods');
    }
}
