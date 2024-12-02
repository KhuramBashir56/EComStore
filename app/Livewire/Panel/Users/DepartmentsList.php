<?php

namespace App\Livewire\Panel\Users;

use App\Models\ActivityLog;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class DepartmentsList extends Component
{
    public $search;

    public function inactiveDepartment(Department $index)
    {
        $this->authorize('admin');
        if ($index->status !== 'inactive') {
            try {
                DB::transaction(function () use ($index) {
                    $index->status = 'inactive';
                    $index->update();
                    ActivityLog::activity($index->id, 'update', 'Department', 'inactivation');
                });
                $this->dispatch('alert', type: 'success', message: 'Department inactive successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'This department already inactive.');
        }
    }

    public function activeDepartment(Department $index)
    {
        $this->authorize('admin');
        if ($index->status !== 'active') {
            try {
                DB::transaction(function () use ($index) {
                    $index->status = 'active';
                    $index->update();
                    ActivityLog::activity($index->id, 'update', 'Department', 'activation');
                });
                $this->dispatch('alert', type: 'success', message: 'Department active successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'This department already active.');
        }
    }

    #[Layout('components.layouts.panel')]
    public function render()
    {
        return view('livewire.panel.users.departments-list', [
            'departments' => Department::where('name', 'LIKE', '%' . $this->search . '%')->select('id', 'name', 'description', 'status')->get(),
        ]);
    }
}
