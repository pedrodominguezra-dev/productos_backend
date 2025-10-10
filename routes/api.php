<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Login route
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Products routes
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
    });

    // Logout route
    Route::post('/logout', [AuthController::class, 'logout']);
});
