<?php

namespace App\Livewire\Panel\Products\Units;

use App\Models\ActivityLog;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;
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
        if ($unit && $unit->status !== 'deleted') {
            $this->unit_id = $unit->id;
            $this->editUnitModal = true;
        } else {
            $this->dispatch('alert', type: 'warning', message: 'Unit already deleted you can not edit it.');
            $this->cancel();
        }
    }

    public function unPublishUnit(Unit $unit)
    {
        $this->authorize('admin');
        if ($unit && $unit->status === 'published') {
            try {
                DB::transaction(function () use ($unit) {
                    $unit->status = 'unpublished';
                    $unit->updated_at = now()->format('Y-m-d H:i:s.u');
                    $unit->update();
                    ActivityLog::activity($unit->id, 'unpublish', 'Product Unit', NULL);
                });
                $this->dispatch('alert', type: 'success', message: 'Unit unpublished successfully');
                $this->cancel();
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
                $this->cancel();
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'Unit already unpublished');
            $this->cancel();
        }
    }

    public function publishUnit(Unit $unit)
    {
        $this->authorize('admin');
        if ($unit && $unit->status === 'unpublished') {
            try {
                DB::transaction(function () use ($unit) {
                    $unit->status = 'published';
                    $unit->updated_at = now()->format('Y-m-d H:i:s.u');
                    $unit->update();
                    ActivityLog::activity($unit->id, 'publish', 'Product Unit', NULL);
                });
                $this->dispatch('alert', type: 'success', message: 'Unit published successfully');
                $this->cancel();
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
                $this->cancel();
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'Unit already published');
            $this->cancel();
        }
    }

    public function deleteUnit(Unit $unit)
    {
        $this->authorize('admin');
        if ($unit && $unit->status !== 'deleted') {
            try {
                DB::transaction(function () use ($unit) {
                    $unit->status = 'deleted';
                    $unit->updated_at = now()->format('Y-m-d H:i:s.u');
                    $unit->update();
                    ActivityLog::activity($unit->id, 'delete', 'Product Unit', NULL);
                });
                $this->dispatch('alert', type: 'success', message: 'Unit deleted successfully');
                $this->cancel();
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
                $this->cancel();
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'Unit already deleted');
            $this->cancel();
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
