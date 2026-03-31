<?php

use Illuminate\Support\Facades\Route;
use Modules\Project\Http\Controllers\Dashboard\ProjectController;
use Modules\Project\Http\Controllers\Dashboard\ProjectImageController;
use Modules\Project\Http\Controllers\Dashboard\ImpactNumberController;
use Modules\Project\Http\Controllers\Dashboard\ChallengeController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group(['prefix' => LaravelLocalization::setLocale() . '/admin', 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:web']], function () {
    Route::controller(ProjectController::class)->name('admin.projects.')->prefix('projects')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{project}', 'edit')->name('edit');
        Route::put('/update/{project}', 'update')->name('update');
        Route::delete('/delete/{project}', 'destroy')->name('destroy');
    });

    Route::controller(ProjectImageController::class)->name('admin.project-images.')->prefix('projects')->group(function () {
        Route::post('/{project}/images/store', 'store')->name('store');
        Route::delete('/images/{projectImage}/delete', 'destroy')->name('destroy');
    });

    Route::controller(ImpactNumberController::class)->name('admin.impact-numbers.')->prefix('impact-numbers')->group(function () {
        Route::get('/edit', 'edit')->name('edit');
        Route::put('/update', 'update')->name('update');
    });

    Route::controller(ChallengeController::class)->name('admin.challenges.')->prefix('challenges')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{challenge}', 'edit')->name('edit');
        Route::put('/update/{challenge}', 'update')->name('update');
        Route::delete('/delete/{challenge}', 'destroy')->name('destroy');
    });
});
