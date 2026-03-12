<?php

use Illuminate\Support\Facades\Route;
use Modules\Service\Http\Controllers\Api\ServiceController;


Route::middleware(['app_language'])->prefix('sni')->group(function () {
    Route::get('/services', [ServiceController::class, 'index'])->name('service.page.show');
});
