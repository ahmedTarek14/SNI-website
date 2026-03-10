<?php

use Illuminate\Support\Facades\Route;
use Modules\Sni\Http\Controllers\SniController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('snis', SniController::class)->names('sni');
});
