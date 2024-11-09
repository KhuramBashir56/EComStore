<?php

namespace App\Livewire\Panel\Products\Units;

use App\Models\Unit;
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
            'code' => ['required', 'max:3', 'alpha', 'regex:/^[A-Z]+$/', 'unique:' . Unit::class . ',code,' . $this->unit->id],
        ]);
        if ($this->unit->status == 'deleted') {
            $this->dispatch('alert', type: 'warning', message: 'Unit already deleted you can not update it.');
        } else {
            try {
                $this->unit->name = $this->name;
                $this->unit->code = $this->code;
                $this->unit->update();
                $this->cancel();
                $this->dispatch('alert', type: 'success', message: 'Unit updated successfully');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        }
    }

    public function cancel()
    {
        $this->reset(['name', 'code']);
        $this->dispatch('closeUnitModal');
    }
}
