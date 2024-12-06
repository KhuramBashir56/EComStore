<?php

namespace App\Livewire\Web\Components;

use Livewire\Component;

class BrandHorizontalCard extends Component
{
    public $brand;

    public function mount($brand)
    {
        $this->brand = $brand;
    }

    public function placeholder()
    {
        return <<<'HTML'
            <div class="w-full flex items-center bg-white dark:bg-gray-800 rounded-md shadow-md group animate-pulse">
                <div class="w-28 aspect-square bg-gray-300 dark:bg-gray-700 flex justify-center items-center">
                    <span class="material-symbols-outlined text-6xl text-white">photo</span>
                </div>
                <div class="flex flex-col p-3 gap-4 relative overflow-hidden w-full">
                    <div class="bg-gray-300 dark:bg-gray-700 h-5 w-full"></div>
                    <div class="bg-gray-300 dark:bg-gray-700 h-4 w-full"></div>
                </div>
            </div>
        HTML;
    }

    public function render()
    {
        return view('livewire.web.components.brand-horizontal-card');
    }
}
