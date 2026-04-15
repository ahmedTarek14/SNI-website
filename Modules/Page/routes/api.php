<?php

use Illuminate\Support\Facades\Route;
use Modules\Page\Http\Controllers\Api\BannerController;


Route::middleware(['app_language'])->prefix('sni')->group(function () {
    Route::get('/home', [BannerController::class, 'homeBanner'])->name('sni.page.show');
    Route::get('/about-sni', [BannerController::class, 'aboutBanner'])->name('sni.about.show');
    Route::get('/contact-us', [BannerController::class, 'contactBanner'])->name('sni.contact.show');
    Route::get('/services', [BannerController::class, 'servicesBanner'])->name('sni.services.show');
    Route::get('/projects', [BannerController::class, 'projectsBanner'])->name('sni.projects.show');
    Route::get('/development', [BannerController::class, 'developmentBanner'])->name('sni.development.show');
});
