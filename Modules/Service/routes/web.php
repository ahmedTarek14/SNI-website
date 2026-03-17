<?php

use Illuminate\Support\Facades\Route;
use Modules\Service\Http\Controllers\Dashboard\ServiceController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale() . '/admin', 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:web']], function () {
    Route::controller(ServiceController::class)->name('admin.services.')->prefix('services')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{service}', 'edit')->name('edit');
        Route::put('/update/{service}', 'update')->name('update');
        Route::delete('/delete/{service}', 'destroy')->name('destroy');
    });
});
