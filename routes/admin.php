<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Panel\Products as PRODUCTS;

Route::middleware(['auth', 'active', 'can:admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('dashboard', App\Livewire\Admin\Dashboard\DashboardIndex::class)->name('dashboard');
    Route::prefix('products')->name('products.')->group(function () {
        Route::prefix('units')->name('units.')->group(function () {
            Route::get('list', PRODUCTS\Units\UnitList::class)->name('list');
        });
    });
});
