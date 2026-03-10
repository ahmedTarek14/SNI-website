<?php

use Illuminate\Support\Facades\Route;
use Modules\Sni\Http\Controllers\SniController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('snis', SniController::class)->names('sni');
});
