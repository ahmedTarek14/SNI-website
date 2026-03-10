<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\SocialMedia\Http\Controllers\Dashboard\SocialMediaController;

Route::group(['prefix' => LaravelLocalization::setLocale() . '/admin', 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:web']], function () {
    Route::controller(SocialMediaController::class)->name('admin.links.')->prefix('social-media')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{socialMedia}', 'edit')->name('edit');
        Route::put('/update/{socialMedia}', 'update')->name('update');
        Route::delete('/delete/{socialMedia}', 'destroy')->name('destroy');
    });
});
