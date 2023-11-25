<?php

namespace App\Http\Validation;

use Kernel\Components\Validation\AbstractValidator;
use Kernel\Components\Validation\Rules\Confirmed;
use Kernel\Components\Validation\Rules\MaxLength;
use Kernel\Components\Validation\Rules\Required;
use Kernel\Components\Validation\Rules\StringRule;
use Kernel\Components\Validation\Rules\Unique;

class UpdateUserRequest extends AbstractValidator
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
                        ->setTable('users')
                        ->setExcept($_SESSION['user']->id),
                    new StringRule(),
                    (new MaxLength())
                        ->setMaxLength(50)
                ],
            'email' =>
                [
                    new Required(),
                    (new Unique())
                        ->setTable('users')
                        ->setExcept($_SESSION['user']->id),
                    (new MaxLength())
                        ->setMaxLength(50)
                ],
            'phone' =>
                [
                    new Required(),
                    (new Unique())
                        ->setTable('users')
                        ->setExcept($_SESSION['user']->id),
                    (new MaxLength())
                        ->setMaxLength(50),
                ],
        ];
    }
}