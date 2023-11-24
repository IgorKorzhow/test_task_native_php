<?php

namespace Kernel\Bootstrap;
use Kernel\Components\Route;
use Kernel\Components\Router\WebRouteRegister;

class App
{
    public function run()
    {
        Route::setContainer(new ServiceContainer());

        (new WebRouteRegister)();
    }

}