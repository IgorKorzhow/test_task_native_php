<?php
/** @var array $data */

$header = 'Show user';

$body = 'Check';

//$body = <<<HTML
//    <form method="post" action="/users/login">
//        <span style="color: red;">{$data['errors']['login_error'][0]}</span>
//        <div>
//            <label for="login_field">Enter phone or email</label>
//            <input name="login_field" type="text" id="login_field" value="{$data['data']['login_field']}" required/>
//            <br>
//            <span style="color: red;">{$data['errors']['login_field'][0]}</span>
//        </div>
//        <div>
//             <label for="password">Password</label>
//            <input type="password" name="password" id="password" required/>
//            <br>
//            <span style="color: red;">{$data['errors']['password'][0]}</span>
//        </div>
//        <button type="submit">Register user</button>
//    </form>
//HTML;

require $_ENV['APP_PROJECT_PATH'] . '/resources/views/layouts/basicLayout.php';
