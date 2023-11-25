<?php
/** @var array $data */

$header = 'Register user';

$body = <<<HTML
    <div class="form-container">
        <form class="form" method="post" action="/users/changePassword">
            <input type="hidden" name="_method" value="PATCH" />
            <span style="color: red;">{$data['errors']['password_error'][0]}</span>
            <div>
                <label for="old_password">Old password</label>
                <input name="old_password" type="password" id="old_password" required/>
                <br>
                <span style="color: red;">{$data['errors']['old_password'][0]}</span>
            </div>
            <div>
                <label for="new_password">New password</label>
                <input name="new_password" type="password" id="new_password" required/>
                <br>
                <span style="color: red;">{$data['errors']['new_password'][0]}</span>
            </div>
            <div>
                <label for="new_password_confirmation">New password confirmation</label>
                <input name="new_password_confirmation" type="password" id="new_password_confirmation" required/>
                <br>
            </div>
            <a class="link-black" href="/users/show">Back</a>
            <button type="submit">Update user password</button>
        </form>
    </div>
HTML;

require $_ENV['APP_PROJECT_PATH'] . '/resources/views/layouts/appLayout.php';
