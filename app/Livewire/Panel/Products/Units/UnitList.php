<?php

namespace App\Livewire\Panel\Products\Units;

use App\Models\Unit;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class UnitList extends Component
{
    public $unit_id, $search;

    public $addUnitModal = false;

    public $editUnitModal = false;

    public function addNewUnit()
    {
        $this->addUnitModal = true;
    }

    public function editUnit(Unit $unit)
    {
        $this->authorize('admin');
        if ($unit->status === 'deleted') {
            $this->dispatch('alert', type: 'warning', message: 'Unit already deleted you can not edit it.');
        } else {
            $this->unit_id = $unit->id;
            $this->editUnitModal = true;
        }
    }

    public function unPublishUnit(Unit $unit)
    {
        $this->authorize('admin');
        if ($unit->status === 'unpublished' && $unit->status === 'deleted') {
            $this->dispatch('alert', type: 'warning', message: 'Unit already unpublished');
        } else {
            try {
                $unit->status = 'unpublished';
                $unit->updated_at = now()->format('Y-m-d H:i:s.u');
                $unit->update();
                $this->dispatch('alert', type: 'success', message: 'Unit unpublished successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        }
    }

    public function publishUnit(Unit $unit)
    {
        $this->authorize('admin');
        if ($unit->status == 'published' && $unit->status === 'deleted') {
            $this->dispatch('alert', type: 'warning', message: 'Unit already published');
        } else {
            try {
                $unit->status = 'published';
                $unit->updated_at = now()->format('Y-m-d H:i:s.u');
                $unit->update();
                $this->dispatch('alert', type: 'success', message: 'Unit published successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        }
    }

    public function deleteUnit(Unit $unit)
    {
        $this->authorize('admin');
        if ($unit->status == 'deleted') {
            $this->dispatch('alert', type: 'warning', message: 'Unit already deleted');
        } else {
            try {
                $unit->status = 'deleted';
                $unit->updated_at = now()->format('Y-m-d H:i:s.u');
                $unit->update();
                $this->dispatch('alert', type: 'success', message: 'Unit deleted successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        }
    }

    #[On('closeUnitModal')]
    public function cancel()
    {
        $this->unit_id = null;
        $this->addUnitModal = false;
        $this->editUnitModal = false;
    }

    #[Layout('components.layouts.panel')]
    public function render()
    {
        return view('livewire.panel.products.units.unit-list', [
            'units' => Unit::where('status', '!=', 'deleted')->where('name', 'LIKE', $this->search . '%')->select('id', 'name', 'code', 'status')->orderBy('name', 'asc')->get(),
        ]);
    }
}
