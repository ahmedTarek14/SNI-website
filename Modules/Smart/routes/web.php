<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Smart\Http\Controllers\Dashboard\SmartBenefitController;
use Modules\Smart\Http\Controllers\Dashboard\SmartFeatureController;

Route::group(['prefix' => LaravelLocalization::setLocale() . '/admin', 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:web']], function () {
    Route::controller(SmartFeatureController::class)->name('admin.smart.features.')->prefix('smart/features')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{smartFeature}', 'edit')->name('edit');
        Route::put('/update/{smartFeature}', 'update')->name('update');
        Route::delete('/delete/{smartFeature}', 'destroy')->name('destroy');
    });

    Route::controller(SmartBenefitController::class)->name('admin.smart.benefits.')->prefix('smart/benefits')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{smartBenefit}', 'edit')->name('edit');
        Route::put('/update/{smartBenefit}', 'update')->name('update');
        Route::delete('/delete/{smartBenefit}', 'destroy')->name('destroy');
    });
});
