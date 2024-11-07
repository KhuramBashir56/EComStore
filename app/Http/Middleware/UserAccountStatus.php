<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserAccountStatus
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->status === 'active') {
            return $next($request);
        } else {
            if (Auth::check() && Auth::user()->status === 'deleted') {
                Auth::logout();
                return redirect()->route('login')->with('error', 'You have deleted your account. If you want to recover your account, please contact the administrator ' . config('app.email') . ' for more information.');
            } elseif (Auth::check() && Auth::user()->status === 'blocked') {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Your account is blocked by the administrator. Please contact the administrator ' . config('app.email') . ' for more information.');
            }
        }
    }
}
