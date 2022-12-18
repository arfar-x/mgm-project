<?php

use App\Services\ProductService\Controllers\CategoryController;
use App\Services\ProductService\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->prefix('api')->group(function () {

    Route::middleware('auth:sanctum')->prefix('admin')->name('admin.')->group(function () {

        Route::apiResource('products', ProductController::class);

        Route::prefix('products')->name('products.')->group(function () {

            Route::patch('/{product}/change-category', [ProductController::class, 'changeCategory'])->name('change-category');
            Route::patch('/{product}/activate', [ProductController::class, 'activate'])->name('activate');
            Route::patch('/{product}/deactivate', [ProductController::class, 'deactivate'])->name('deactivate');
            Route::post('/{product}/upload', [ProductController::class, 'upload'])->name('upload');
            Route::delete('/{product}/{uuid}', [ProductController::class, 'deleteFile'])->name('delete-file');
            Route::patch('/{product}/{uuid}', [ProductController::class, 'setCover'])->name('set-cover');
        });

        Route::prefix('categories/products')->group(function () {

            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::post('/', [CategoryController::class, 'store'])->name('store');
            Route::get('/{category}', [CategoryController::class, 'show'])->name('show');
            Route::patch('/{category}', [CategoryController::class, 'update'])->name('update');
            Route::delete('/{category}', [CategoryController::class, 'delete'])->name('destroy');

            Route::patch('/{category}/activate', [CategoryController::class, 'activate'])->name('activate');
            Route::patch('/{category}/deactivate', [CategoryController::class, 'deactivate'])->name('deactivate');
            Route::post('/{category}/upload', [CategoryController::class, 'upload'])->name('upload');
            Route::delete('/{category}/{uuid}', [CategoryController::class, 'deleteFile'])->name('delete-file');
        });
    });

    Route::prefix('panel/products')->name('panel.products.')->group(function () {

        Route::get('/categories', [CategoryController::class, 'index'])->name('index');
        Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('show');
        Route::get('/categories/{category}/get-products', [CategoryController::class, 'getProducts'])->name('get-products');

        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/{product}', [ProductController::class, 'show'])->name('show');

    });
});