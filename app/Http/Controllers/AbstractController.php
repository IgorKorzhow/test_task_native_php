<?php

namespace App\Http\Controllers;

abstract class AbstractController
{
    public function render(string $path, array $params) {
        require $_ENV['APP_PROJECT_PATH'] . '/resources/views' . $path;
    }
}