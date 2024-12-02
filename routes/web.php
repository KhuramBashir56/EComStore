<?php

use Illuminate\Support\Facades\Route;

// Route::view('/', 'mail.news-letter-subscription-email')->name('home');
Route::get('/', App\Livewire\Web\Home\HomeIndex::class)->name('home');
Route::get('products', App\Livewire\Web\Home\HomeIndex::class)->name('products');
Route::get('contact-us', App\Livewire\Web\Home\HomeIndex::class)->name('contact');
Route::prefix('order')->name('order.')->group(function () {
    Route::get('tracking', App\Livewire\Web\Order\Tracking::class)->name('tracking');
});

Route::get('newsletter-subscription-confirmation/{ref_id}', [App\Http\Controllers\NewsLetterSubscriptionController::class, 'confirmation'])->name('newsletter_subscription_confirmation');

require __DIR__ . '/admin.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/buyer.php';
