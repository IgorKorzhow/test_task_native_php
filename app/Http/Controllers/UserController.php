<?php

namespace App\Http\Controllers;

use App\Http\Validation\CreateUserRequest;
use App\Http\Validation\LoginUserRequest;
use App\Models\User;
use App\Repository\UserRepository;
use JetBrains\PhpStorm\NoReturn;
use Kernel\Components\Controller\AbstractController;

class UserController extends AbstractController
{

    public function __construct(public UserRepository $userRepository)
    {
    }

    public function registrationView(): void
    {
        $this->render('/user/registrationUserView.php', $_SESSION['data'] ?: []);
    }

    /**
     * @param CreateUserRequest $createUserRequest
     * @param UserRepository $userRepository
     * @return void
     */
    #[NoReturn] public function registration(CreateUserRequest $createUserRequest, UserRepository $userRepository): void
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

        $this->redirect('/users/show');
    }

    public function loginView(): void
    {
        $this->render('/user/loginUserView.php', $_SESSION['data'] ?: []);
    }

    public function login(LoginUserRequest $loginUserRequest, UserRepository $userRepository)
    {
        $validationResult = $loginUserRequest->validated();

        if (count($validationResult['errors']) > 0) {
            $_SESSION['data'] = $validationResult;
            $this->redirect('/users/login');
        }

        $user = $userRepository->login($validationResult['data']);

        if (!$user) {
            $_SESSION['data']['errors']['login_error'][0] = 'Problem with login or password';
            $this->redirect('/users/login');
        }

        $_SESSION['user'] = $user;

        $this->redirect('/users/show');
    }

    public function showUserInfo() {
        $this->render('/users/show',$_SESSION['data'] ?: []);
    }
}