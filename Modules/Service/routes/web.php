<?php

use Illuminate\Support\Facades\Route;
use Modules\Service\Http\Controllers\Dashboard\ServiceController;
use Modules\Service\Http\Controllers\Dashboard\ServiceFeatureController;
use Modules\Service\Http\Controllers\Dashboard\ServiceProcessController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale() . '/admin', 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:web']], function () {
    Route::controller(ServiceController::class)->name('admin.services.')->prefix('services')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{service}', 'edit')->name('edit');
        Route::put('/update/{service}', 'update')->name('update');
        Route::delete('/delete/{service}', 'destroy')->name('destroy');
    });

    // Service Features
    Route::controller(ServiceFeatureController::class)->name('admin.service-features.')->prefix('services')->group(function () {
        Route::post('/{service}/features/store', 'store')->name('store');
        Route::delete('/features/{feature}/delete', 'destroy')->name('destroy');
    });

    // Service Processes
    Route::controller(ServiceProcessController::class)->name('admin.service-processes.')->prefix('services')->group(function () {
        Route::post('/{service}/processes/store', 'store')->name('store');
        Route::delete('/processes/{process}/delete', 'destroy')->name('destroy');
    });
});
