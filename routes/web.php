<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Web as WEB;

Route::get('/', WEB\Home\HomeIndex::class)->name('home');

require __DIR__ . '/admin.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/panel.php';
