<?php

use Illuminate\Support\Facades\Route;
use Modules\Project\Http\Controllers\Dashboard\ProjectController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group(['prefix' => LaravelLocalization::setLocale() . '/admin', 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:web']], function () {
    Route::controller(ProjectController::class)->name('admin.projects.')->prefix('projects')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{project}', 'edit')->name('edit');
        Route::put('/update/{project}', 'update')->name('update');
        Route::delete('/delete/{project}', 'destroy')->name('destroy');
    });
});
