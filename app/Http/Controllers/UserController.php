<?php

namespace App\Http\Controllers;

use App\Http\Validation\ChangePasswordRequest;
use App\Http\Validation\CreateUserRequest;
use App\Http\Validation\LoginUserRequest;
use App\Http\Validation\UpdateUserRequest;
use App\Models\User;
use App\Repository\UserRepository;
use App\Services\YandexCaptchaService;
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
     * @param YandexCaptchaService $captchaService
     * @return void
     * @throws \JsonException
     */
    #[NoReturn] public function registration(CreateUserRequest $createUserRequest, YandexCaptchaService $captchaService): void
    {
        $validationResult = $createUserRequest->validated();

        if (!$captchaService->checkCaptcha($validationResult['smart-token'])) {
            $_SESSION['data']['data'] = $validationResult;
            $_SESSION['data']['errors']['captcha'][0] = 'Problem with captcha';
            $this->redirectBack();
        }

        $this->userRepository->store($validationResult);

        /** @var User|null $user */
        $user = $this->userRepository->getByEmail($validationResult['email']);

        unset($_SESSION['data']);

        $_SESSION['user'] = $user;

        $this->redirect('/');
    }

    public function loginView(): void
    {
        $this->render('/user/loginUserView.php', $_SESSION['data'] ?: []);
    }

    #[NoReturn] public function login(LoginUserRequest $loginUserRequest, YandexCaptchaService $captchaService): void
    {
        $validationResult = $loginUserRequest->validated();

        if (!$captchaService->checkCaptcha($validationResult['smart-token'])) {
            $_SESSION['data']['data'] = $validationResult;
            $_SESSION['data']['errors']['captcha'][0] = 'Problem with captcha';
            $this->redirectBack();
        }

        $user = $this->userRepository->login($validationResult);

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

    #[NoReturn] public function updateUser(UpdateUserRequest $updateUserRequest): void
    {
        $validationResult = $updateUserRequest->validated();

        $this->userRepository->updateWithoutPassword($validationResult, $_SESSION['user']->id);

        $_SESSION['user'] = $this->userRepository->getById($_SESSION['user']->id);

        unset($_SESSION['data']);

        $this->redirect('/users/show');
    }

    public function showChangePasswordForm(): void
    {
        $this->render('/user/changePasswordView.php', $_SESSION['data'] ?: []);
    }

    #[NoReturn] public function changePassword(ChangePasswordRequest $changePasswordRequest): void
    {
        $validationResult = $changePasswordRequest->validated();

        /** @var User $user */
        $user = $_SESSION['user'];

        if (!password_verify($validationResult['old_password'], $user->password)) {
            $_SESSION['data']['errors']['password_error'][0] = 'Problem with old password';
            $this->redirect('/users/changePassword');
        }

        $this->userRepository->updatePassword($validationResult, $_SESSION['user']->id);

        $_SESSION['user'] = $this->userRepository->getById($_SESSION['user']->id);

        unset($_SESSION['data']);

        $this->redirect('/users/show');
    }
}