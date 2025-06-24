<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\Api\CategoryController;

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
/**
 * カテゴリ関連
 */
Route::prefix('categories')->middleware([AuthMiddleware::class])->group(callback: function () {
    Route::GET('/', [CategoryController::class, 'getList']);
    Route::POST('/parent', [CategoryController::class, 'createParentCategory']);
    Route::POST('/child', [CategoryController::class, 'createChildCategory']);
    Route::PUT('/{id}', [CategoryController::class, 'updateCategory']);
    Route::DELETE('/{id}', [CategoryController::class, 'deleteCategory']);
});
