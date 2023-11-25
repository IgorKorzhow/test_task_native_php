<?php

namespace App\Http\Middlewares;

use Kernel\Components\Middleware\IMiddleware;

class AuthMiddleware implements IMiddleware
{
    public function __invoke(): void
    {
        if (empty($_SESSION['user'])) {
            header('Location: ' . $_ENV['APP_URL']. '/users/login');
            die();
        }
    }
}