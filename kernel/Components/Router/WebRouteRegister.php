<?php

namespace Kernel\Components\Router;

use App\Http\Middlewares\SessionStartMiddleware;
use App\Http\Middlewares\SetCorrectRequestMethodMiddleware;

class WebRouteRegister implements IRouteRegister
{
    public function __invoke(): void
    {
        $this->callMiddlewares();
        require_once $_ENV['APP_PROJECT_PATH'] . '/routes/web.php';
    }

    public function getMiddlewares(): array
    {
        return [
            new SetCorrectRequestMethodMiddleware(),
            new SessionStartMiddleware(),
        ];
    }

    public function callMiddlewares(): void
    {
        foreach ($this->getMiddlewares() as $middleware) {
            $middleware();
        }
    }
}