<?php
/** @var array $data */

$header = 'Register user';

$body = <<<HTML
    <div class="form-container">
        <form class="form" method="post" action="/users/login">
            <span style="color: red;">{$data['errors']['login_error'][0]}</span>
            <div>
                <label for="login_field">Enter phone or email</label>
                <input name="login_field" type="text" id="login_field" value="{$data['data']['login_field']}" required/>
                <br>
                <span style="color: red;">{$data['errors']['login_field'][0]}</span>
            </div>
            <div>
                <label for="password">Password</label>                
                <input type="password" name="password" id="password" required/>
                <br>
                <span style="color: red;">{$data['errors']['password'][0]}</span>
            </div>
            <button type="submit">Login user</button>
        </form>
    </div>
HTML;

require $_ENV['APP_PROJECT_PATH'] . '/resources/views/layouts/appLayout.php';
