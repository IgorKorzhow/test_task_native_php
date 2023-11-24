<?php
/** @var array $data */

$header = 'Register user';

$body = <<<HTML
    <form method="post" action="/users">
        <div>
            <label for="name">Name</label>
            <input name="name" type="text" id="name" value="{$data['data']['name']}" />
            <br>
            <span style="color: red;">{$data['errors']['name'][0]}</span>
        </div>
        <div>
            <label for="phone">Phone</label>
            <input name="phone" type="text" id="phone" value="{$data['data']['phone']}" />
            <br>
            <span style="color: red;">{$data['errors']['phone'][0]}</span>
        </div>
        <div>
            <label for="email">Email</label>
            <input name="email" type="email" id="email" value="{$data['data']['email']}" />
            <br>
            <span style="color: red;">{$data['errors']['email'][0]}</span>

        </div>
        <div>
             <label for="password">Password</label>
            <input type="password" name="password" id="password" />
            <br>
            <span style="color: red;">{$data['errors']['password'][0]}</span>
        </div>
        <div>
            <label for="password_confirmation">Password confirmation</label>
            <input type="password" name="password_confirmation" id="password_confirmation" />
            <br>
            <span style="color: red;">{$data['errors']['password_confirmation'][0]}</span>

        </div>
        <button type="submit">Register user</button>
    </form>
HTML;

require $_ENV['APP_PROJECT_PATH'] . '/resources/views/layouts/basicLayout.php';
