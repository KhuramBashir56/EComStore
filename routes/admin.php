<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'active', 'can:admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('dashboard', App\Livewire\Admin\Dashboard\DashboardIndex::class)->name('dashboard');
});
