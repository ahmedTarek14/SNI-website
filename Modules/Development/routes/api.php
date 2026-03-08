<?php

use Illuminate\Support\Facades\Route;
use Modules\Development\Http\Controllers\DevelopmentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('developments', DevelopmentController::class)->names('development');
});
