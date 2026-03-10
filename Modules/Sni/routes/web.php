<?php

/**
 * dashboard page Routes
 */

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Sni\Http\Controllers\Dashboard\HomeController;

Route::group(['prefix' => LaravelLocalization::setLocale() . '/admin', 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:web']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('admin.dashboard');
});
