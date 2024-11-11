<?php

namespace App\Livewire\Panel\Users;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class UsersList extends Component
{
    use WithPagination;

    public $type;

    public $search;

    #[Layout('components.layouts.panel')]
    public function render()
    {
        $user = User::where('role_id', '!=', Role::admin()->id)->whereAny(['name', 'email', 'phone'], 'LIKE', '%' . $this->search . '%')->with([
            'role:id,name',
        ])->select('id', 'name', 'email', 'role_id', 'status');
        if (!empty($this->type)) {
            $user = $user->where('role_id', 'LIKE', $this->type);
        }
        return view('livewire.panel.users.users-list', [
            'users' => $user->orderBy('name')->paginate(100),
            'roles' => Role::where('status', '!=', 'deleted')->whereNotIn('id', [Role::admin()->id])->select('id', 'name')->orderBy('name')->get()
        ]);
    }
}
