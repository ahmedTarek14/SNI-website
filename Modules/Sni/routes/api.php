<?php

use Illuminate\Support\Facades\Route;
use Modules\Sni\Http\Controllers\Api\ContactController;
use Modules\Sni\Http\Controllers\Api\SniPageController;

Route::middleware(['app_language'])->prefix('sni')->group(function () {
    Route::get('/home', [SniPageController::class, 'index'])->name('sni.page.show');
    Route::get('/contact-us', [ContactController::class, 'index'])->name('sni.contact.show');
    Route::post('/contact-us/send', [ContactController::class, 'store'])->name('sni.contact.store');
});
