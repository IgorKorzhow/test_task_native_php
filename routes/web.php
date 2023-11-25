<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middlewares\AuthMiddleware;
use Kernel\Components\Router\Route;

Route::get('/', [ProductController::class, 'index']);

Route::get('/users/register', [UserController::class, 'registrationView']);

Route::post('/users/register', [UserController::class, 'registration']);

Route::get('/users/login', [UserController::class, 'loginView']);

Route::post('/users/login', [UserController::class, 'login']);

Route::middlewares([new AuthMiddleware()], static function () {
    Route::get('/users/show', [UserController::class, 'showUserInfo']);

    Route::get('/users/changePassword', [UserController::class, 'showChangePasswordForm']);

    Route::patch('/users/changePassword', [UserController::class, 'changePassword']);

    Route::get('/users/logout', [UserController::class, 'logout']);

    Route::patch('/users/update', [UserController::class, 'updateUser']);
});