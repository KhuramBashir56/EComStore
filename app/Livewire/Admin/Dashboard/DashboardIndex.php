<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Component;

class DashboardIndex extends Component
{
    #[Layout('components.layouts.panel')]
    public function render()
    {
        return view('livewire.admin.dashboard.dashboard-index');
    }
}
