<?php

namespace App\Http\Controllers;


use App\Http\Validation\ValidatedData;

class UserController extends AbstractController
{

    public function create(): void
    {
        $this->render('/user/createUserView.php', ['check' => 'hi']);
    }

    /**
     * @param ValidatedData $data
     * @return void
     */
    public function store(ValidatedData $validatedData): void
    {
        $data = $validatedData->validated();
    }
}