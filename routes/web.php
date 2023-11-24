<?php

use App\Http\Controllers\UserController;
use Kernel\Components\Router\Route;

Route::get('/users/register', [UserController::class, 'registrationView']);

Route::post('/users/register', [UserController::class, 'registration']);

Route::get('/users/login', [UserController::class, 'loginView']);

Route::post('/users/login', [UserController::class, 'login']);