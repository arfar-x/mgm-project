<?php

use App\Services\CustomerService\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->prefix('api')->group(function () {

    Route::middleware('auth:sanctum')->prefix('admin/customers')->name('admin.customers.')->group(function () {

        Route::get('/', [CustomerController::class, 'index'])->name('index');
        Route::get('/{customer}', [CustomerController::class, 'show'])->name('show');
        Route::patch('/{customer}', [CustomerController::class, 'update'])->name('update');
        Route::delete('/{customer}', [CustomerController::class, 'delete'])->name('delete');
        Route::patch('/{customer}/activate', [CustomerController::class, 'activate'])->name('activate');
        Route::patch('/{customer}/deactivate', [CustomerController::class, 'deactivate'])->name('deactivate');
        Route::post('/{customer}/upload', [CustomerController::class, 'upload'])->name('upload');
        Route::delete('/{customer}/{uuid}', [CustomerController::class, 'deleteFile'])->name('delete-file');
        Route::patch('/{customer}/{uuid}', [CustomerController::class, 'setAvatar'])->name('set-avatar');

    });

    Route::prefix('panel/customers')->name('panel.customers.')->group(function () {
        
        Route::get('/', [CustomerController::class, 'index'])->name('index');
        Route::get('/{customer}', [CustomerController::class, 'show'])->name('show');
        Route::post('/', [CustomerController::class, 'store'])->name('store');
        
    });

});
