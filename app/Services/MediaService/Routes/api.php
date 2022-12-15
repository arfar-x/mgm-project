<?php

use App\Services\MediaService\Controllers\MediaController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->prefix('api')->group(function () {

    Route::prefix('media')->name('media.')->group(function () {

        Route::middleware('auth:sanctum')
            ->post('upload', [MediaController::class, 'upload'])->name('upload');

        Route::get('{uuid}', [MediaController::class, 'download'])->name('download');

    });
});
