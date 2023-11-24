<?php

namespace App\Http\Controllers;

use App\Http\Validation\CreateUserRequest;
use App\Models\User;
use App\Repository\UserRepository;
use JetBrains\PhpStorm\NoReturn;
use Kernel\Components\Controller\AbstractController;

class UserController extends AbstractController
{

    public function create(): void
    {
        $this->render('/user/createUserView.php', $_SESSION['data'] ?: []);
    }

    /**
     * @param CreateUserRequest $createUserRequest
     * @param UserRepository $userRepository
     * @return void
     */
    #[NoReturn] public function store(CreateUserRequest $createUserRequest, UserRepository $userRepository): void
    {
        $validationResult = $createUserRequest->validated();

        if (count($validationResult['errors']) > 0) {
            $_SESSION['data'] = $validationResult;
            $this->redirect('/users/register');
        }

        $userRepository->store($validationResult['data']);

        /** @var User|null $user */
        $user = $userRepository->getByEmail($validationResult['data']['email']);

        $_SESSION['user'] = $user;

        $this->redirect('/user');
    }


}