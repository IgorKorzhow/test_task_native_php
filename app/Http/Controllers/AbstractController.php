<?php

namespace App\Http\Controllers;

use JetBrains\PhpStorm\NoReturn;

abstract class AbstractController
{
    public function render(string $path, array $params) {
        require $_ENV['APP_PROJECT_PATH'] . '/resources/views' . $path;
    }

    public function redirect($path, $statusCode = 303): void
    {
        header('Location: ' . $_ENV['APP_URL'] . $path, true, $statusCode);
        die();
    }
}