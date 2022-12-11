<?php

use App\Services\SettingService\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->prefix('api')->group(function () {
    Route::prefix('settings')->name('setting.')->group(function () {

        Route::get('{slug}', [SettingController::class, 'getBySlug'])->name('get-by-slug');
        Route::get('{slug}/value', [SettingController::class, 'getValueBySlug'])->name('get-value-by-slug');

    });
});