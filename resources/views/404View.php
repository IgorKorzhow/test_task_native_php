<?php
/** @var array $data */

$header = 'Not fount';

$body = <<<HTML
    <main class="main-content">
        This page is not found
    </main>
HTML;

require $_ENV['APP_PROJECT_PATH'] . '/resources/views/layouts/appLayout.php';
