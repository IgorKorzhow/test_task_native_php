<?php
/** @var array $data */

$header = 'Update user';

$body = <<<HTML
    <div class="form-container">
        <form class="form" method="post" action="/users/update">
            <input type="hidden" name="_method" value="PATCH" />
            <div>
                <label for="name">Name</label>
                <input name="name" type="text" id="name" value="{$_SESSION['user']->name}" required/>
                <br>
                <span style="color: red;">{$data['errors']['name'][0]}</span>
            </div>
            <div>
                <label for="phone">Phone</label>
                <input name="phone" type="text" id="phone" value="{$_SESSION['user']->phone}" required/>
                <br>
                <span style="color: red;">{$data['errors']['phone'][0]}</span>
            </div>
            <div>
                <label for="email">Email</label>
                <input name="email" type="email" id="email" value="{$_SESSION['user']->email}" required/>
                <br>
                <span style="color: red;">{$data['errors']['email'][0]}</span>
            </div>
            <a class="link-black" href="/users/changePassword">Change password</a>
            <button type="submit">Update user info</button>
        </form>
    </div>
HTML;

require $_ENV['APP_PROJECT_PATH'] . '/resources/views/layouts/appLayout.php';
