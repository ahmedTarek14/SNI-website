<?php

use Illuminate\Support\Facades\Route;
use Modules\Project\Http\Controllers\Api\ProjectController;


Route::middleware(['app_language'])->prefix('sni')->group(function () {
    Route::get('/projects', [ProjectController::class, 'index'])->name('project.page.index');
    Route::get('/projects/{id}/detail', [ProjectController::class, 'detail'])->name('project.page.detail');
    Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('project.page.show');
    Route::get('/categories', [ProjectController::class, 'all'])->name('project.page.all');
});
