<?php

use App\Services\ProductService\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->prefix('api')->group(function () {

    Route::middleware('auth:sanctum')->prefix('admin')->name('admin.')->group(function () {

        Route::apiResource('products', ProductController::class);

        Route::prefix('products')->name('products.')->group(function () {
            Route::patch('/{product}/activate', [ProductController::class, 'activate'])->name('activate');
            Route::patch('/{product}/deactivate', [ProductController::class, 'deactivate'])->name('deactivate');
            Route::post('/{product}/upload', [ProductController::class, 'upload'])->name('upload');
            Route::delete('/{product}/{uuid}', [ProductController::class, 'deleteFile'])->name('delete-file');
            Route::patch('/{product}/{uuid}', [ProductController::class, 'setCover'])->name('set-cover');
        });

    });

    Route::prefix('panel/products')->name('panel.products.')->group(function () {

        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/{product}', [ProductController::class, 'show'])->name('show');

    });
});