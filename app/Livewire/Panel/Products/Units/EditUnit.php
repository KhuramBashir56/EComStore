<?php

namespace App\Livewire\Panel\Products\Units;

use App\Models\ActivityLog;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditUnit extends Component
{
    public $unit, $name, $code;

    public function mount(Unit $unit)
    {
        $this->unit = $unit;
        $this->name = $unit->name;
        $this->code = $unit->code;
    }

    public function updateUnit()
    {
        $this->authorize('admin');
        $this->validate([
            'name' => ['required', 'string', 'max:48', 'unique:' . Unit::class . ',name,' . $this->unit->id],
            'code' => ['required', 'max:3', 'alpha', 'uppercase', 'max:3', 'unique:' . Unit::class . ',code,' . $this->unit->id],
        ]);
        if ($this->unit->status !== 'deleted') {
            try {
                DB::transaction(function () {
                    $this->unit->name = $this->name;
                    $this->unit->code = $this->code;
                    $this->unit->update();
                    ActivityLog::activity($this->unit->id, 'update', 'Product Unit', NULL);
                });
                $this->cancel();
                $this->dispatch('alert', type: 'success', message: 'Unit updated successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        } else {
            $this->dispatch('alert', type: 'warning', message: 'Unit already deleted you can not update it.');
        }
    }

    public function cancel()
    {
        $this->reset(['name', 'code']);
        $this->dispatch('closeUnitModal');
    }
}
