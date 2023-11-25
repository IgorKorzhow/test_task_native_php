<?php

namespace App\Http\Controllers;

use App\Http\Validation\ChangePasswordRequest;
use App\Http\Validation\CreateUserRequest;
use App\Http\Validation\LoginUserRequest;
use App\Http\Validation\UpdateUserRequest;
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

        unset($_SESSION['data']);

        $_SESSION['user'] = $user;

        $this->redirect('/');
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

        unset($_SESSION['data']);

        $_SESSION['user'] = $user;

        $this->redirect('/');
    }

    #[NoReturn] public function logout(): void
    {
        unset($_SESSION['user']);

        $this->redirect('/');
    }

    public function showUserInfo(): void
    {
        $this->render('/user/updateUserView.php', $_SESSION['data'] ?: []);
    }

    #[NoReturn] public function updateUser(UpdateUserRequest $updateUserRequest, UserRepository $userRepository): void
    {
        $validationResult = $updateUserRequest->validated();

        $userRepository->updateWithoutPassword($validationResult, $_SESSION['user']->id);

        $_SESSION['user'] = $userRepository->getById($_SESSION['user']->id);

        unset($_SESSION['data']);

        $this->redirect('/users/show');
    }

    public function showChangePasswordForm(): void
    {
        $this->render('/user/changePasswordView.php', $_SESSION['data'] ?: []);
    }

    #[NoReturn] public function changePassword(ChangePasswordRequest $changePasswordRequest, UserRepository $userRepository): void
    {
        $validationResult = $changePasswordRequest->validated();

        /** @var User $user */
        $user = $_SESSION['user'];

        if (!password_verify($validationResult['old_password'], $user->password)) {
            $_SESSION['data']['errors']['password_error'][0] = 'Problem with old password';
            $this->redirect('/users/changePassword');
        }

        $userRepository->updatePassword($validationResult, $_SESSION['user']->id);

        $_SESSION['user'] = $userRepository->getById($_SESSION['user']->id);

        unset($_SESSION['data']);

        $this->redirect('/users/show');
    }
}