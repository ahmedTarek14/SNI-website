<?php

use Illuminate\Support\Facades\Route;
use Modules\Smart\Http\Controllers\SmartController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('smarts', SmartController::class)->names('smart');
});
