<?php

use Illuminate\Support\Facades\Route;
use Modules\SocialMedia\Http\Controllers\Api\SocialMediaController;

Route::prefix('sni')->middleware('app_language')
    ->group(function () {
        Route::get('/social-media', [SocialMediaController::class, 'index'])->name('social_media.index');
    });
