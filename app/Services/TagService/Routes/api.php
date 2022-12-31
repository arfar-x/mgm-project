<?php

use App\Services\TagService\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->prefix('api')->group(function () {

    Route::middleware('auth:sanctum')->prefix('admin/tags')->name('admin.tags.')->group(function () {

        Route::get('/', [TagController::class, 'index'])->name('index');
        Route::post('/', [TagController::class, 'store'])->name('store');
        Route::get('/{tag}', [TagController::class, 'show'])->name('show');
        Route::patch('/{tag}', [TagController::class, 'update'])->name('update');
        Route::delete('/{tag}', [TagController::class, 'destroy'])->name('destroy');

        Route::patch('/{tag}/activate', [TagController::class, 'activate'])->name('activate');
        Route::patch('/{tag}/deactivate', [TagController::class, 'deactivate'])->name('deactivate');

    });

    Route::prefix('panel/tags')->name('panel.tags.')->group(function () {

        Route::get('/', [TagController::class, 'index'])->name('index');
        Route::get('/{tag}', [TagController::class, 'show'])->name('show');

    });

});
