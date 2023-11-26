<?php

namespace App\Http\Validation;

use Kernel\Components\Validation\AbstractValidator;
use Kernel\Components\Validation\Rules\Confirmed;
use Kernel\Components\Validation\Rules\MaxLength;
use Kernel\Components\Validation\Rules\Required;
use Kernel\Components\Validation\Rules\StringRule;
use Kernel\Components\Validation\Rules\Unique;

class ChangePasswordRequest extends AbstractValidator
{
    public function __construct()
    {
        $this->data = $_POST;
    }

    protected function rules(): array
    {
        return [
            'old_password' =>
                [
                    new Required(),
                    (new MaxLength())
                        ->setMaxLength(255),
                ],
            'new_password' =>
                [
                    new Required(),
                    (new MaxLength())
                        ->setMaxLength(255),
                    (new Confirmed())
                        ->setConfirmationField(
                            ['new_password_confirmation' => $this->data['new_password_confirmation']]
                        ),
                ],
        ];
    }
}