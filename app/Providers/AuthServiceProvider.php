<?php

namespace App\Providers;

use App\Gates\AdminGate;
use App\Gates\BuyerGate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::define('admin', [AdminGate::class, 'verify_admin']);
        Gate::define('buyer', [BuyerGate::class, 'verify_buyer']);
    }
}
