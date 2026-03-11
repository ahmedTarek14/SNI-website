<?php

use Illuminate\Support\Facades\Route;
use Modules\Sni\Http\Controllers\Api\SniPageController;

Route::middleware(['app_language'])->prefix('sni')->group(function () {
    Route::get('/home', [SniPageController::class, 'index'])->name('sni.page.show');
});
