<?php

namespace App\Http\Validation;

use Kernel\Components\Validation\AbstractValidator;
use Kernel\Components\Validation\Rules\Confirmed;
use Kernel\Components\Validation\Rules\MaxLength;
use Kernel\Components\Validation\Rules\Required;
use Kernel\Components\Validation\Rules\StringRule;
use Kernel\Components\Validation\Rules\Unique;

class CreateUserRequest extends AbstractValidator
{
    public function __construct()
    {
        $this->data = $_POST;
    }

    protected function rules(): array
    {
        return [
            'name' =>
                [
                    new Required(),
                    (new Unique())
                        ->setTable('users'),
                    new StringRule(),
                    (new MaxLength())
                        ->setMaxLength(50)
                ],
            'email' =>
                [
                    new Required(),
                    (new Unique())
                        ->setTable('users'),
                    (new MaxLength())
                        ->setMaxLength(50)
                ],
            'password' =>
                [
                    new Required(),
                    (new MaxLength())
                        ->setMaxLength(255),
                    (new Confirmed())
                        ->setConfirmationField(
                            ['password_confirmation' => $this->data['password_confirmation']]
                        ),
                ],
            'phone' =>
                [
                    new Required(),
                    (new Unique())
                        ->setTable('users'),
                    (new MaxLength())
                        ->setMaxLength(50),
                ],
        ];
    }
}