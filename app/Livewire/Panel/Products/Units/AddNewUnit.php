<?php

namespace App\Livewire\Panel\Products\Units;

use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddNewUnit extends Component
{
    public $name, $code;

    public function saveUnit()
    {
        $this->authorize('admin');
        try {
            $this->validate([
                'name' => ['required', 'string', 'max:48', 'unique:' . Unit::class . ',name'],
                'code' => ['required', 'max:3', 'alpha', 'regex:/^[A-Z]+$/', 'unique:' . Unit::class . ',code'],
            ]);
            $unit = new Unit;
            $unit->author_id = Auth::user()->id;
            $unit->name = $this->name;
            $unit->code = $this->code;
            $unit->save();
            $this->cancel();
            $this->dispatch('alert', type: 'success', message: 'New Unit Added Successfully');
        } catch (\Throwable $th) {
            $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
        }
    }

    public function cancel()
    {
        $this->reset(['name', 'code']);
        $this->dispatch('closeUnitModal');
    }
}
