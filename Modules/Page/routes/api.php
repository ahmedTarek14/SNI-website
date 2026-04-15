<?php

use Illuminate\Support\Facades\Route;
use Modules\Page\Http\Controllers\Api\BannerController;


Route::middleware(['app_language'])->prefix('sni/banner')->group(function () {
    Route::get('/home', [BannerController::class, 'homeBanner'])->name('sni.banner.home.show');
    Route::get('/about-sni', [BannerController::class, 'aboutBanner'])->name('sni.banner.about.show');
    Route::get('/contact-us', [BannerController::class, 'contactBanner'])->name('sni.banner.contact.show');
    Route::get('/services', [BannerController::class, 'servicesBanner'])->name('sni.banner.services.show');
    Route::get('/projects', [BannerController::class, 'projectsBanner'])->name('sni.banner.projects.show');
    Route::get('/development', [BannerController::class, 'developmentBanner'])->name('sni.banner.development.show');
});
