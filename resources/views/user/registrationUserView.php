<?php
/** @var array $data */

$header = 'Register user';

var_dump($data);

$body = <<<HTML
    <div class="form-container" style="margin-top: 30px">
        <form class="form" method="post" action="/users/register">
            <div>
                <label for="name">Name</label>
                <input name="name" type="text" id="name" value="{$data['data']['name']}" required/>
                <br>
                <span style="color: red;">{$data['errors']['name'][0]}</span>
            </div>
            <div>
                <label for="phone">Phone</label>
                <input name="phone" type="text" id="phone" value="{$data['data']['phone']}" required/>
                <br>
                <span style="color: red;">{$data['errors']['phone'][0]}</span>
            </div>
            <div>
                <label for="email">Email</label>
                <input name="email" type="email" id="email" value="{$data['data']['email']}" required/>
                <br>
                <span style="color: red;">{$data['errors']['email'][0]}</span>
    
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required/>
                <br>
                <span style="color: red;">{$data['errors']['password'][0]}</span>
            </div>
            <div>
                <label for="password_confirmation">Password confirmation</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required/>
                <br>
                <span style="color: red;">{$data['errors']['password_confirmation'][0]}</span>
            </div>
            <div id="captcha-container" class="smart-captcha" data-sitekey="">
            </div>
            <input type="hidden" name="smart-token" value="<токен>">
            <button type="submit">Register user</button>
        </form>
    </div>
    <script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>
HTML;

require $_ENV['APP_PROJECT_PATH'] . '/resources/views/layouts/appLayout.php';
