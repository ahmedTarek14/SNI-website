<?php

use Illuminate\Support\Facades\Route;
use Modules\Development\Http\Controllers\DevelopmentController;
use Modules\Development\Http\Controllers\Api\DevPageController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('developments', DevelopmentController::class)->names('development');
});

Route::middleware(['app_language'])->prefix('sni')->group(function () {
    Route::get('/app-development', [DevPageController::class, 'index'])->name('dev.page.show');
});
