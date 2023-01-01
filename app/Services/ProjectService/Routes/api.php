<?php

use App\Services\ProjectService\Controllers\CategoryController;
use App\Services\ProjectService\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->prefix('api')->group(function () {

    Route::middleware('auth:sanctum')->prefix('admin/projects')->name('admin.projects.')->group(function () {

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

        Route::get('/', [ProjectController::class, 'index'])->name('index');
        Route::post('/', [ProjectController::class, 'store'])->name('store');
        Route::get('/{project}', [ProjectController::class, 'show'])->name('show');
        Route::patch('/{project}', [ProjectController::class, 'update'])->name('update');
        Route::delete('/{project}', [ProjectController::class, 'destroy'])->name('destroy');

        Route::patch('/{project}/change-category', [ProjectController::class, 'changeCategory'])->name('change-category');
        Route::patch('/{project}/activate', [ProjectController::class, 'activate'])->name('activate');
        Route::patch('/{project}/deactivate', [ProjectController::class, 'deactivate'])->name('deactivate');
        Route::post('/{project}/upload', [ProjectController::class, 'upload'])->name('upload');
        Route::get('/{project}/tags', [ProjectController::class, 'getTags'])->name('get-tags');
        Route::patch('/{project}/tags/sync', [ProjectController::class, 'syncTags'])->name('sync-tags');
        Route::patch('/{project}/set-cover', [ProjectController::class, 'setCover'])->name('set-cover');
        Route::delete('/{project}/{uuid}', [ProjectController::class, 'deleteFile'])->name('delete-file');

    });

    Route::prefix('panel/projects')->name('panel.projects.')->group(function () {

        Route::get('/categories', [CategoryController::class, 'index'])->name('index');
        Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('show');
        Route::get('/categories/{category}/get-projects', [CategoryController::class, 'getProjects'])->name('get-projects');

        Route::get('/', [ProjectController::class, 'index'])->name('index');
        Route::get('/{project}', [ProjectController::class, 'show'])->name('show');

    });
});
