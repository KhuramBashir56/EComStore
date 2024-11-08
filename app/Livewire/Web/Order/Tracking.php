<?php

namespace App\Livewire\Web\Order;

use Livewire\Attributes\Layout;
use Livewire\Component;

use function PHPSTORM_META\type;

class Tracking extends Component
{
    public $tracking_id;

    public function track()
    {
        $this->validate([
            'tracking_id' => ['required', 'digits:10'],
        ]);
        $this->reset(['tracking_id']);
    }

    #[Layout('components.layouts.web')]
    public function render()
    {
        return view('livewire.web.order.tracking');
    }
}
