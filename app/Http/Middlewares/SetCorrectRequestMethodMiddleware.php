<?php

namespace App\Http\Middlewares;

use Kernel\Components\Middleware\IMiddleware;
use Kernel\Enum\RequestMethod;

class SetCorrectRequestMethodMiddleware implements IMiddleware
{
    public function __invoke(): void
    {
        if (($_SERVER['REQUEST_METHOD'] === RequestMethod::POST->value) && (!empty($_POST['_method']))) {
            $_SERVER['REQUEST_METHOD'] = $_POST['_method'];
        }

        unset($_POST['_method']);
    }
}