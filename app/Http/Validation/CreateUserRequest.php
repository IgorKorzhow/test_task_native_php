<?php

namespace App\Http\Validation;

use Kernel\Components\Validation\AbstractValidator;
use Kernel\Components\Validation\Rules\Required;
use Kernel\Components\Validation\Rules\StringRule;

class CreateUserRequest extends AbstractValidator
{
    public function __construct()
    {
        $this->data = $_POST;
    }

    protected function rules(): array
    {
        return [
            'name' => [new Required(), new StringRule()],
            'email' => [new Required()],
        ];
    }
}