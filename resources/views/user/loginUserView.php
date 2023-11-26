<?php
/** @var array $data */

$header = 'Login user';

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
            <div id="captcha-container" class="smart-captcha" data-sitekey="">
            </div>
            <div>
                <span style="color: red;">{$data['errors']['captcha'][0]}</span>            
            </div>
            <input type="hidden" name="smart-token" value="">
            <button type="submit">Login user</button>
        </form>
    </div>
    <script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>
HTML;

require $_ENV['APP_PROJECT_PATH'] . '/resources/views/layouts/appLayout.php';
