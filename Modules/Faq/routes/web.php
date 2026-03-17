<?php

use Illuminate\Support\Facades\Route;
use Modules\Faq\Http\Controllers\Dashboard\FaqController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('faqs', FaqController::class)->names('faq');
});


Route::group(['prefix' => LaravelLocalization::setLocale() . '/admin', 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:web']], function () {
    Route::controller(FaqController::class)->name('admin.faqs.')->prefix('faqs')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{faq}', 'edit')->name('edit');
        Route::put('/update/{faq}', 'update')->name('update');
        Route::delete('/delete/{faq}', 'destroy')->name('destroy');
    });
});
