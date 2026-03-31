<?php

use Illuminate\Support\Facades\Route;
use Modules\Service\Http\Controllers\Api\ServiceController;


Route::middleware(['app_language'])->prefix('sni')->group(function () {
    Route::get('/services/all', [ServiceController::class, 'all'])->name('service.page.all');
    Route::get('/services', [ServiceController::class, 'index'])->name('service.page.index');
    Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('service.page.show');
});
