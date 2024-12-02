<?php

namespace App\Livewire\Panel\Users;

use App\Models\ActivityLog;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class RolesList extends Component
{
    public $search;

    public function inactiveRole(Role $index)
    {
        $this->authorize('admin');
        if ($index->status !== 'inactive') {
            try {
                DB::transaction(function () use ($index) {
                    $index->status = 'inactive';
                    $index->update();
                    ActivityLog::activity($index->id, 'update', 'Role', 'inactivation');
                });
                $this->dispatch('alert', type: 'success', message: 'Role inactive successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'This role already inactive.');
        }
    }

    public function activeRole(Role $index)
    {
        $this->authorize('admin');
        if ($index->status !== 'active') {
            try {
                DB::transaction(function () use ($index) {
                    $index->status = 'active';
                    $index->update();
                    ActivityLog::activity($index->id, 'update', 'Role', 'activation');
                });
                $this->dispatch('alert', type: 'success', message: 'Role active successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'This role already active.');
        }
    }

    #[Layout('components.layouts.panel')]
    public function render()
    {
        return view('livewire.panel.users.roles-list', [
            'roles' => Role::where('name', 'LIKE', '%' . $this->search . '%')->select('id', 'name', 'description', 'status')->orderBy('name')->get(),
        ]);
    }
}
