<?php

namespace App\Gates;

use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class AdminGate
{
    public function verify_admin(): bool
    {
        return Auth::check() && Auth::user()->role_id === Role::admin()->id && Auth::user()->role->status === 'active' && Auth::user()->status === 'active';
    }
}
