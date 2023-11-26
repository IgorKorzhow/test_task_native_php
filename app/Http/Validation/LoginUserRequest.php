<?php

namespace App\Http\Validation;

use Kernel\Components\Validation\AbstractValidator;
use Kernel\Components\Validation\Rules\MaxLength;
use Kernel\Components\Validation\Rules\Required;
use Kernel\Components\Validation\Rules\StringRule;

final class LoginUserRequest extends AbstractValidator
{
    public function __construct()
    {
        $this->data = $_POST;
    }

    protected function rules(): array
    {
        return [
            'login_field' =>
                [
                    new Required(),
                    new StringRule(),
                ],
            'password' =>
                [
                    new Required(),
                    (new MaxLength())
                        ->setMaxLength(255),
                ],
        ];
    }
}