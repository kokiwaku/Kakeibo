<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Middleware\AuthMiddleware;

/**
 * 認証関連
 */
Route::prefix('auth')->group(function () {
    Route::POST('validate_token', [AuthController::class, 'validateToken']);
    Route::POST('login', [AuthController::class, 'login']);
    Route::POST('logout', [AuthController::class, 'logout']);
    Route::POST('register', [AuthController::class, 'register']);
    Route::middleware([AuthMiddleware::class])->group(function () {
        Route::POST('user_info', [AuthController::class, 'getUserInfo']);
    });
});