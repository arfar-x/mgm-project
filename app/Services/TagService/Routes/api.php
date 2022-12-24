<?php

use App\Services\TagService\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->prefix('api')->group(function () {

    Route::middleware('auth:sanctum')->prefix('admin')->name('admin.')->group(function () {

        Route::apiResource('tags', TagController::class);

        Route::prefix('tags')->name('tags.')->group(function () {
            Route::patch('/{tag}/activate', [TagController::class, 'activate'])->name('activate');
            Route::patch('/{tag}/deactivate', [TagController::class, 'deactivate'])->name('deactivate');
        });
        
    });

    Route::prefix('panel/tags')->name('panel.tags.')->group(function () {

        Route::get('/', [TagController::class, 'index'])->name('index');
        Route::get('/{tag}', [TagController::class, 'show'])->name('show');

    });

});
