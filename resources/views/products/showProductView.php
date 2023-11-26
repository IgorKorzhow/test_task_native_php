<?php
/** @var array $data */

$header = 'Show user';

$body = <<<HTML
    <main class="main-content">
        This is main page
    </main>
HTML;

require $_ENV['APP_PROJECT_PATH'] . '/resources/views/layouts/appLayout.php';
