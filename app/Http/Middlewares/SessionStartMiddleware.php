<?php

namespace App\Http\Middlewares;

use Kernel\Components\Middleware\IMiddleware;

class SessionStartMiddleware implements IMiddleware
{
    public function __invoke(): void
    {
        session_start();
    }
}