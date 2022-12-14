<?php

use App\Services\AuthenticationService\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->prefix('api')->group(function () {

    Route::middleware('auth:sanctum')->prefix('admin/auth')->name('admin.auth.')->group(function () {

            Route::withoutMiddleware('auth:sanctum')
                ->post('login', [AuthenticationController::class, 'login'])->name('login');

            Route::post('register', [AuthenticationController::class, 'register'])->name('register');

            Route::delete('logout', [AuthenticationController::class, 'logout'])->name('logout');
            Route::patch('update', [AuthenticationController::class, 'update'])->name('update');
            Route::get('me', [AuthenticationController::class, 'me'])->name('me');
            Route::patch('change-password', [AuthenticationController::class, 'changePassword'])->name('change-password');

        });

});