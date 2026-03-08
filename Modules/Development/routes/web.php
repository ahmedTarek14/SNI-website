<?php

use Illuminate\Support\Facades\Route;
use Modules\Development\Http\Controllers\DevelopmentController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('developments', DevelopmentController::class)->names('development');
});
