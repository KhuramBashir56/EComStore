<?php

namespace App\Livewire\Panel\Users;

use Livewire\Attributes\Layout;
use Livewire\Component;

class AddNewUser extends Component
{
    #[Layout('components.layouts.panel')]
    public function render()
    {
        return view('livewire.panel.users.add-new-user');
    }
}
