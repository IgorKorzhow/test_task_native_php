<?php

namespace Kernel\components;

class WebRouteRegister
{
    public function __invoke()
    {
        require_once $_ENV['APP_PROJECT_PATH'] . '/routes/web.php';
    }
}