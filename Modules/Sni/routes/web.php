<?php

/**
 * dashboard page Routes
 */

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Sni\Http\Controllers\Dashboard\HomeController;
use Modules\Sni\Http\Controllers\Dashboard\AboutController;
use Modules\Sni\Http\Controllers\Dashboard\ReviewController;
use Modules\Sni\Http\Controllers\Dashboard\VendorController;
use Modules\Sni\Http\Controllers\Dashboard\WhyItemController;
use Modules\Sni\Http\Controllers\Dashboard\CoreValueController;
use Modules\Sni\Http\Controllers\Dashboard\TeamMemberController;

Route::group(['prefix' => LaravelLocalization::setLocale() . '/admin', 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:web']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('admin.dashboard');

    Route::controller(AboutController::class)->name('admin.about.')->prefix('about-us')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{about}', 'edit')->name('edit');
        Route::put('/update/{about}', 'update')->name('update');
        Route::delete('/delete/{about}', 'destroy')->name('destroy');
    });

    Route::controller(ReviewController::class)->name('admin.reviews.')->prefix('reviews')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{review}', 'edit')->name('edit');
        Route::put('/update/{review}', 'update')->name('update');
        Route::delete('/delete/{review}', 'destroy')->name('destroy');
    });

    Route::controller(VendorController::class)->name('admin.vendors.')->prefix('vendors')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{vendor}', 'edit')->name('edit');
        Route::put('/update/{vendor}', 'update')->name('update');
        Route::delete('/delete/{vendor}', 'destroy')->name('destroy');
    });

    Route::controller(WhyItemController::class)->name('admin.why-items.')->prefix('why-items')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{whyItem}', 'edit')->name('edit');
        Route::put('/update/{whyItem}', 'update')->name('update');
        Route::delete('/delete/{whyItem}', 'destroy')->name('destroy');
    });

    Route::controller(CoreValueController::class)->name('admin.core-values.')->prefix('core-values')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{coreValue}', 'edit')->name('edit');
        Route::put('/update/{coreValue}', 'update')->name('update');
        Route::delete('/delete/{coreValue}', 'destroy')->name('destroy');
    });

    Route::controller(TeamMemberController::class)->name('admin.team-members.')->prefix('team-members')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{teamMember}', 'edit')->name('edit');
        Route::put('/update/{teamMember}', 'update')->name('update');
        Route::delete('/delete/{teamMember}', 'destroy')->name('destroy');
    });
});
