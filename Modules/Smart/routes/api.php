<?php

use Illuminate\Support\Facades\Route;
use Modules\Smart\Http\Controllers\Api\SmartController;

Route::middleware(['app_language'])->prefix('sni')->group(function () {
    Route::get('/smart-home', [SmartController::class, 'index'])->name('smart.page.show');
});
