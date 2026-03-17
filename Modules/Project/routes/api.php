<?php

use Illuminate\Support\Facades\Route;
use Modules\Project\Http\Controllers\Api\ProjectController;


Route::middleware(['app_language'])->prefix('sni')->group(function () {
    Route::get('/projects', [ProjectController::class, 'index'])->name('project.page.show');
});
