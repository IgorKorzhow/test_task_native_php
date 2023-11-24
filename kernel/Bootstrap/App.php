<?php

namespace Kernel\Bootstrap;
use Kernel\Components\Route;
use Kernel\Components\WebRouteRegister;

class App
{
    public function run()
    {
        Route::setContainer(new ServiceContainer());

        (new WebRouteRegister)();
    }

}