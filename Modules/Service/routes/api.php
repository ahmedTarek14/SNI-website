<?php

use Illuminate\Support\Facades\Route;
use Modules\Service\Http\Controllers\Api\ServiceController;


Route::middleware(['app_language'])->prefix('sni')->group(function () {
    Route::get('/services', [ServiceController::class, 'index'])->name('service.page.index');
    Route::get('/services/{id}', [ServiceController::class, 'show'])->name('service.page.show');
    Route::get('/services/all', [ServiceController::class, 'all'])->name('service.page.all');
});
