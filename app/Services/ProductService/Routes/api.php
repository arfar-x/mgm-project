<?php

use App\Services\ProductService\Controllers\CategoryController;
use App\Services\ProductService\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->prefix('api')->group(function () {

    Route::middleware('auth:sanctum')->prefix('admin/products')->name('admin.products.')->group(function () {

        Route::prefix('/categories')->group(function () {

            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::post('/', [CategoryController::class, 'store'])->name('store');
            Route::get('/{category}', [CategoryController::class, 'show'])->name('show');
            Route::patch('/{category}', [CategoryController::class, 'update'])->name('update');
            Route::delete('/{category}', [CategoryController::class, 'delete'])->name('destroy');

            Route::patch('/{category}/activate', [CategoryController::class, 'activate'])->name('activate');
            Route::patch('/{category}/deactivate', [CategoryController::class, 'deactivate'])->name('deactivate');
            Route::post('/{category}/upload', [CategoryController::class, 'upload'])->name('upload');
            Route::delete('/{category}/{uuid}', [CategoryController::class, 'deleteFile'])->name('delete-file');
            Route::patch('/{category}/{uuid}', [CategoryController::class, 'setCover'])->name('set-cover');
        });

        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{product}', [ProductController::class, 'show'])->name('show');
        Route::patch('/{product}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');

        Route::patch('/{product}/change-category', [ProductController::class, 'changeCategory'])->name('change-category');
        Route::patch('/{product}/activate', [ProductController::class, 'activate'])->name('activate');
        Route::patch('/{product}/deactivate', [ProductController::class, 'deactivate'])->name('deactivate');
        Route::post('/{product}/upload', [ProductController::class, 'upload'])->name('upload');
        Route::get('/{product}/tags', [ProductController::class, 'getTags'])->name('get-tags');
        Route::patch('/{product}/tags/sync', [ProductController::class, 'syncTags'])->name('sync-tags');
        Route::delete('/{product}/{uuid}', [ProductController::class, 'deleteFile'])->name('delete-file');
        Route::patch('/{product}/set-cover', [ProductController::class, 'setCover'])->name('set-cover');

    });

    Route::prefix('panel/products')->name('panel.products.')->group(function () {

        Route::get('/categories', [CategoryController::class, 'index'])->name('index');
        Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('show');
        Route::get('/categories/{category}/get-products', [CategoryController::class, 'getProducts'])->name('get-products');

        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/{product}', [ProductController::class, 'show'])->name('show');

        Route::get('/{product}/tags', [ProductController::class, 'getTags'])->name('get-tags');

    });
});
