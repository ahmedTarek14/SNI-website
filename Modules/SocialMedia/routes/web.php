<?php

use Illuminate\Support\Facades\Route;
use Modules\SocialMedia\Http\Controllers\SocialMediaController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('socialmedia', SocialMediaController::class)->names('socialmedia');
});
