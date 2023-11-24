<?php

namespace App\Http\Controllers;

use App\Http\Validation\CreateUserRequest;

class UserController extends AbstractController
{

    public function create(): void
    {
        $this->render('/user/createUserView.php', ['check' => 'hi']);
    }

    /**
     * @param CreateUserRequest $createUserRequest
     * @return void
     */
    public function store(CreateUserRequest $createUserRequest): void
    {
        $validationResult = $createUserRequest->validated();

        if (count($validationResult['errors']) > 0) {
            $this->redirect('/users/register');
        }
    }
}