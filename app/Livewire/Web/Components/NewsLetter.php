<?php

namespace App\Livewire\Web\Components;

use Livewire\Component;

class NewsLetter extends Component
{
    public $email;

    public function subscribe()
    {
        // $this->validate([
        //     'email' => ['required', 'email'],
        // ]);
        $this->dispatch('alert', type: 'success', message: 'Login Failed. Please try again with your correct credentials.');
    }

    public function render()
    {
        return view('livewire.web.components.news-letter');
    }
}
