<?php

use Illuminate\Support\Facades\Route;
use Modules\Settings\Http\Controllers\Dashboard\LocationController;
use Modules\Settings\Http\Controllers\Dashboard\SettingsController;
use Modules\Settings\Http\Controllers\Dashboard\WorkHourController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale() . '/admin', 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:web']], function () {
    Route::controller(LocationController::class)->name('admin.locations.')->prefix('locations')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{location}', 'edit')->name('edit');
        Route::put('/update/{location}', 'update')->name('update');
        Route::delete('/delete/{location}', 'destroy')->name('destroy');
    });

    Route::controller(SettingsController::class)->name('admin.settings.')->prefix('settings')->group(function () {
        // Route::get('/', 'index')->name('index');
        // Route::post('/store', 'store')->name('store');
        Route::get('/edit/{setting}', 'edit')->name('edit');
        Route::put('/update/{setting}', 'update')->name('update');
        // Route::delete('/delete/{setting}', 'destroy')->name('destroy');
    });

    Route::controller(WorkHourController::class)->prefix('work-hours')->name('admin.work-hours.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{workHour}', 'edit')->name('edit');
        Route::put('/update/{workHour}', 'update')->name('update');
        Route::delete('/delete/{workHour}', 'destroy')->name('destroy');
    });
});
