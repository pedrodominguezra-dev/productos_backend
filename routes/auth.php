<?php

use App\Http\Controllers\Api\AuthController as Controller;
use Illuminate\Support\Facades\Route;

// Login route
Route::post('/login', [Controller::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // User info route
    Route::get('/user', [Controller::class, 'me']);
    // Logout route
    Route::post('/logout', [Controller::class, 'logout']);
});
