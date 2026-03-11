<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Page\Http\Controllers\Dashboard\PageController;

Route::group(['prefix' => LaravelLocalization::setLocale() . '/admin', 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:web']], function () {
    Route::controller(PageController::class)->name('admin.pages.')->prefix('pages')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{page}', 'edit')->name('edit');
        Route::put('/update/{page}', 'update')->name('update');
        Route::delete('/delete/{page}', 'destroy')->name('destroy');
    });

    // banners CRUD (formerly headers)
    Route::controller(\Modules\Page\Http\Controllers\Dashboard\BannerController::class)
        ->name('admin.banners.')->prefix('banners')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{banner}', 'edit')->name('edit');
            Route::put('/update/{banner}', 'update')->name('update');
            Route::delete('/delete/{banner}', 'destroy')->name('destroy');
        });

    // sections CRUD
    Route::controller(\Modules\Page\Http\Controllers\Dashboard\SectionController::class)
        ->name('admin.sections.')->prefix('sections')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{section}', 'edit')->name('edit');
            Route::put('/update/{section}', 'update')->name('update');
            Route::delete('/delete/{section}', 'destroy')->name('destroy');
        });
});
