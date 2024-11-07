<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'index'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
    Route::get('register', [RegisteredUserController::class, 'index'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store'])->name('register.store');
});

Route::middleware(['auth', 'active'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Dashboard::class, 'dashboard'])->name('dashboard');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
