<?php

use App\Http\Controllers\UserController;
use Kernel\components\Route;

Route::get('/users/register', [UserController::class, 'create']);

Route::post('/users', [UserController::class, 'store']);