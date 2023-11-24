<?php

namespace Kernel\Components;

class WebRouteRegister
{
    public function __invoke()
    {
        require_once $_ENV['APP_PROJECT_PATH'] . '/routes/web.php';
    }
}