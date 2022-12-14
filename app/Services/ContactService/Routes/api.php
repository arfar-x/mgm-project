<?php

use App\Services\ContactService\Controllers\ContactControllers;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->prefix('api')->group(function () {

    Route::middleware('auth:sanctum')->prefix('admin/contacts')->name('admin.contacts.')->group(function () {

        Route::get('/', [ContactControllers::class, 'index'])->name('index');
        Route::get('/{contact}', [ContactControllers::class, 'show'])->name('show');
        Route::patch('/{contact}', [ContactControllers::class, 'update'])->name('update');
        Route::delete('/{contact}', [ContactControllers::class, 'delete'])->name('delete');

    });

    Route::prefix('panel/contacts')->name('panel.contacts.')->group(function () {

        Route::post('/', [ContactControllers::class, 'store'])->name('store');
        
    });

});