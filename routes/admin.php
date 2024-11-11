<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Panel\Products as PRODUCTS;

Route::middleware(['auth', 'active', 'can:admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('dashboard', App\Livewire\Admin\Dashboard\DashboardIndex::class)->name('dashboard');
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('units', PRODUCTS\Units\UnitList::class)->name('units');
        Route::prefix('brands')->name('brands.')->group(function () {
            Route::get('list', PRODUCTS\Brands\BrandsList::class)->name('list');
            Route::get('add', PRODUCTS\Brands\AddNewBrand::class)->name('add');
            Route::get('{brand}/edit', PRODUCTS\Brands\EditBrand::class)->name('edit');
            Route::get('{brand}/details', PRODUCTS\Brands\BrandDetails::class)->name('details');
        });
        Route::prefix('sub-categories')->name('sub_categories.')->group(function () {
            Route::get('list', PRODUCTS\SubCategories\SubCategoriesList::class)->name('list');
            Route::get('add', PRODUCTS\SubCategories\AddNewSubCategory::class)->name('add');
            Route::get('edit/{id}', PRODUCTS\SubCategories\EditSubCategory::class)->name('edit');
        });
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('add', App\Livewire\Panel\Users\AddNewUser::class)->name('add');
            Route::get('list', App\Livewire\Panel\Users\UsersList::class)->name('list');
            Route::get('news-letter-subscribers', App\Livewire\Panel\Users\NewsLetterSubscribersList::class)->name('news_letter_subscribers');
        });
    });
});
