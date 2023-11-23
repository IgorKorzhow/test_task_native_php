<?php

namespace App\Http\Controllers;

use App\Http\Validation\ValidatedData;

class UserController extends AbstractController
{

    public function create(): void
    {
        $this->render('/user/createUserView.php', ['check' => 'hi']);
    }

    public function store(ValidatedData $data)
    {

    }
}