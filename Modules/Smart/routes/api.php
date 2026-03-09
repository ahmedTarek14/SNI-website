<?php

use Illuminate\Support\Facades\Route;
use Modules\Smart\Http\Controllers\SmartController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('smarts', SmartController::class)->names('smart');
});
