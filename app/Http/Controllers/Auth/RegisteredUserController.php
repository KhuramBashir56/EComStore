<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function index(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:22'],
            'last_name' => ['required', 'string', 'max:22'],
            'phone' => ['required', 'string', 'min:11', 'max:11', 'unique:' . User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user = new User;
        $user->ref_id = User::refId();
        $user->role_id = 1;
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->created_at = now()->format('Y-m-d H:i:s.u');
        $user->save();
        return redirect(route('login', absolute: false));
    }
}
