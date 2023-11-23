<?php

namespace Kernel\bootstrap;
use Kernel\components\Route;
use Kernel\components\WebRouteRegister;

class App
{
    public function run()
    {
        Route::setContainer(new ServiceContainer());

        (new WebRouteRegister)();
    }

}