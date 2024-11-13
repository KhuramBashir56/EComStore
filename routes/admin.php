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
            Route::get('{brand}/add-categories', PRODUCTS\Brands\AddCategories::class)->name('add_categories');
        });
        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('list', PRODUCTS\Categories\CategoriesList::class)->name('list');
            Route::get('add', PRODUCTS\Categories\AddNewCategory::class)->name('add');
            Route::get('{category}/edit', PRODUCTS\Categories\EditCategory::class)->name('edit');
            Route::get('{category}/details', PRODUCTS\Categories\CategoryDetails::class)->name('details');
        });
        Route::prefix('sub-categories')->name('sub_categories.')->group(function () {
            Route::get('list', PRODUCTS\SubCategories\SubCategoriesList::class)->name('list');
            Route::get('add', PRODUCTS\SubCategories\AddNewSubCategory::class)->name('add');
            Route::get('{category}/edit', PRODUCTS\SubCategories\EditSubCategory::class)->name('edit');
            Route::get('{category}/details', PRODUCTS\SubCategories\SubCategoryDetails::class)->name('details');
            Route::get('{category}/add-brands', PRODUCTS\SubCategories\AddBrands::class)->name('add_brands');
        });
        Route::prefix('add-product')->name('add_product.')->group(function () {
            Route::get('overview', PRODUCTS\ProductOverview::class)->name('overview');
            Route::get('overview/{product}', PRODUCTS\EditProductOverview::class)->name('edit_overview');
        });
        Route::prefix('edit-product')->name('edit_product.')->group(function () {
            Route::get('overview/{product}', PRODUCTS\EditProductOverview::class)->name('overview');
        });
        Route::get('list', PRODUCTS\ProductsList::class)->name('list');
    });
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('add', App\Livewire\Panel\Users\AddNewUser::class)->name('add');
        Route::get('list', App\Livewire\Panel\Users\UsersList::class)->name('list');
        Route::get('news-letter-subscribers', App\Livewire\Panel\Users\NewsLetterSubscribersList::class)->name('news_letter_subscribers');
        Route::get('latest-activities', App\Livewire\Panel\Users\ActivityLogs::class)->name('latest_activities');
    });
});
