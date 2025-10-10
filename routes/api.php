<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Login route
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Products routes
    Route::prefix('products')->group(function (){
        Route::get('/', [ProductController::class, 'index']);
    });

    // Logout route
    Route::post('/logout', [AuthController::class, 'logout']);

});