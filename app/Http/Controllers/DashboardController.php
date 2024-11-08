<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (Gate::allows('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif (Gate::allows('buyer')) {
            return redirect()->route('buyer.dashboard');
        } else {
            abort(403);
        }
    }
}
