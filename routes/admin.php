<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'active', 'can:admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('dashboard', App\Livewire\Admin\Dashboard\DashboardIndex::class)->name('dashboard');
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('units', App\Livewire\Panel\Products\Units\UnitList::class)->name('units');
        Route::prefix('brands')->name('brands.')->group(function () {
            Route::get('list', App\Livewire\Panel\Products\Brands\BrandsList::class)->name('list');
            Route::get('add', App\Livewire\Panel\Products\Brands\AddNewBrand::class)->name('add');
            Route::get('edit/{brand}', App\Livewire\Panel\Products\Brands\EditBrand::class)->name('edit');
            Route::get('details/{brand}', App\Livewire\Panel\Products\Brands\BrandDetails::class)->name('details');
            Route::get('add-categories/{brand}', App\Livewire\Panel\Products\Brands\AddCategories::class)->name('add_categories');
        });
        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('list', App\Livewire\Panel\Products\Categories\CategoriesList::class)->name('list');
            Route::get('add', App\Livewire\Panel\Products\Categories\AddNewCategory::class)->name('add');
            Route::get('edit/{category}', App\Livewire\Panel\Products\Categories\EditCategory::class)->name('edit');
            Route::get('details/{category}', App\Livewire\Panel\Products\Categories\CategoryDetails::class)->name('details');
        });
        Route::prefix('sub-categories')->name('sub_categories.')->group(function () {
            Route::get('list', App\Livewire\Panel\Products\SubCategories\SubCategoriesList::class)->name('list');
            Route::get('add', App\Livewire\Panel\Products\SubCategories\AddNewSubCategory::class)->name('add');
            Route::get('edit/{category}', App\Livewire\Panel\Products\SubCategories\EditSubCategory::class)->name('edit');
            Route::get('details/{category}', App\Livewire\Panel\Products\SubCategories\SubCategoryDetails::class)->name('details');
            Route::get('add-brands/{category}', App\Livewire\Panel\Products\SubCategories\AddBrands::class)->name('add_brands');
        });
        Route::get('list', App\Livewire\Panel\Products\ProductsList::class)->name('list');
        Route::prefix('add-product')->name('add_product.')->group(function () {
            Route::get('overview', App\Livewire\Panel\Products\ProductOverview::class)->name('overview');
            Route::get('overview/{product}', App\Livewire\Panel\Products\EditProductOverview::class)->name('edit_overview');
            Route::get('pricing-and-colors/{product}', App\Livewire\Panel\Products\PricingAndColors::class)->name('pricing_and_colors');
            Route::get('content-and-description/{product}', App\Livewire\Panel\Products\Description::class)->name('content_and_description');
            Route::get('gallery/{product}', App\Livewire\Panel\Products\Gallery::class)->name('gallery');
        });
        Route::prefix('edit-product')->name('edit_product.')->group(function () {
            Route::get('overview/{product}', App\Livewire\Panel\Products\EditProductOverview::class)->name('overview');
            Route::get('pricing-and-colors/{product}', App\Livewire\Panel\Products\PricingAndColors::class)->name('pricing_and_colors');
            Route::get('content-and-description/{product}', App\Livewire\Panel\Products\Description::class)->name('content_and_description');
            Route::get('gallery/{product}', App\Livewire\Panel\Products\Gallery::class)->name('gallery');
        });
    });
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('add', App\Livewire\Panel\Users\AddNewUser::class)->name('add');
        Route::get('list', App\Livewire\Panel\Users\UsersList::class)->name('list');
        Route::get('news-letter-subscribers', App\Livewire\Panel\Users\NewsLetterSubscribersList::class)->name('news_letter_subscribers');
        Route::get('latest-activities', App\Livewire\Panel\Users\ActivityLogs::class)->name('latest_activities');
        Route::get('roles', App\Livewire\Panel\Users\RolesList::class)->name('roles');
        Route::get('departments', App\Livewire\Panel\Users\DepartmentsList::class)->name('departments');
    });
});
