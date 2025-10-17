<?php

use App\Http\Controllers\Api\ProductController as Controller;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    // Products routes
    Route::prefix('products')->group(function () {
        Route::get('/', [Controller::class, 'index']);
    });
});
