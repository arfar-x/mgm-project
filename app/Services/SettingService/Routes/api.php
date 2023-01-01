<?php

use App\Services\SettingService\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->prefix('api')->group(function () {

    Route::middleware('auth:sanctum')->prefix('admin/settings')->name('admin.settings.')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('index');
        Route::post('/', [SettingController::class, 'store'])->name('store');
        Route::get('/{setting}', [SettingController::class, 'show'])->name('show');
        Route::patch('/{setting}', [SettingController::class, 'update'])->name('update');
        Route::delete('/{setting}', [SettingController::class, 'delete'])->name('delete');
        Route::patch('/{setting}/activate', [SettingController::class, 'activate'])->name('activate');
        Route::patch('/{setting}/deactivate', [SettingController::class, 'deactivate'])->name('deactivate');
    });

    Route::prefix('panel/settings')->name('panel.settings.')->group(function () {

        Route::get('/short-list', [SettingController::class, 'getShortList'])->name('short-list');

        // Get permanent settings which are used for most pages
        Route::patch('/permanent', [SettingController::class, 'getPermanent'])->name('permanent');

        Route::get('{slug}', [SettingController::class, 'getBySlug'])->name('get-by-slug');
        Route::get('{slug}/value', [SettingController::class, 'getValueBySlug'])->name('get-value-by-slug');
    });
});
