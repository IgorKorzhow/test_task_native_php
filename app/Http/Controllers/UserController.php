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

        $userRepository->store($validationResult);

        /** @var User|null $user */
        $user = $userRepository->getByEmail($validationResult['email']);

        $_SESSION['user'] = $user;

        $this->redirect('/users/show');
    }

    public function loginView(): void
    {
        $this->render('/user/loginUserView.php', $_SESSION['data'] ?: []);
    }

    #[NoReturn] public function login(LoginUserRequest $loginUserRequest, UserRepository $userRepository): void
    {
        $validationResult = $loginUserRequest->validated();

        $user = $userRepository->login($validationResult);

        if (!$user) {
            $_SESSION['data']['errors']['login_error'][0] = 'Problem with login or password';
            $this->redirect('/users/login');
        }

        $_SESSION['user'] = $user;

        $this->redirect('/users/show');
    }

    public function showUserInfo(): void
    {
        $user = $_SESSION['user'];

        $this->render('/user/showUserView.php', ['user' => $user]);
    }
}