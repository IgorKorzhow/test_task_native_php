<?php

$header = 'Register user';

$body = <<<HTML
    <form method="post" action="/users">
        <div>
            <label for="name">Name</label>
            <input name="name" type="text" id="name">
        </div>
            <label for="phone">Phone</label>
            <input name="phone" type="text" id="phone">
        <div>
            <label for="email">Email</label>
            <input name="email" type="email" id="email">
        </div>
        <div>
             <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <label for="password_confirmation">Password confirmation</label>
            <input type="password" name="password_confirmation" id="password_confirmation">
        </div>
        <button type="submit">Register user</button>
    </form>
HTML;

require $_ENV['APP_PROJECT_PATH'] . '/resources/views/layouts/basicLayout.php';
