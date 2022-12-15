<?php

use App\Services\ProductService\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->prefix('api')->group(function () {

    Route::middleware('auth:sanctum')->prefix('admin')->name('admin.')->group(function () {

        Route::apiResource('products', ProductController::class);

        Route::prefix('products')->name('products.')->group(function () {
            Route::patch('/{product}/activate', [ProductController::class, 'activate'])->name('activate');
            Route::patch('/{product}/deactivate', [ProductController::class, 'deactivate'])->name('deactivate');
        });

    });

    Route::prefix('panel/products')->name('panel.products.')->group(function () {

        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/{product}', [ProductController::class, 'show'])->name('show');

    });
});