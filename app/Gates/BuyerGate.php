<?php

namespace App\Gates;

use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class BuyerGate
{
    public function verify_buyer(): bool
    {
        return Auth::check() && Auth::user()->role_id === Role::buyer()->id && Auth::user()->role->status === 'active' && Auth::user()->status === 'active';
    }
}
