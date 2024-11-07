<?php

namespace App\Livewire\Web\Components\Footer;

use Livewire\Component;

class PaymentMethods extends Component
{
    public function placeholder()
    {
        return <<<HTML
            <div class="flex flex-wrap gap-4 items-center md:justify-start justify-center">
                <div class="h-10 aspect-video bg-primary-700 dark:bg-gray-500 animate-pulse"></div>
                <div class="h-10 aspect-video bg-primary-700 dark:bg-gray-500 animate-pulse"></div>
                <div class="h-10 aspect-video bg-primary-700 dark:bg-gray-500 animate-pulse"></div>
                <div class="h-10 aspect-video bg-primary-700 dark:bg-gray-500 animate-pulse"></div>
            </div>
        HTML;
    }

    public function render()
    {
        return view('livewire.web.components.footer.payment-methods');
    }
}
