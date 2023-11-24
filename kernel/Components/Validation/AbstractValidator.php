<?php

namespace Kernel\Components\Validation;

use Kernel\Components\Validation\Rules\AbstractValidationRule;

abstract class AbstractValidator
{
    protected array $errors = [];
    protected array $data = [];

    public function validated(): array
    {
        foreach ($this->rules() as $fieldName => $rules) {
            foreach ($rules as $ruleClosure) {
                /** @var AbstractValidationRule $ruleClosure */
                if (!$ruleClosure->validate($fieldName, $this->data[$fieldName])) {
                    $this->errors[$fieldName][] = $ruleClosure->message;
                }
            }
        }

        return [
            'data' => $this->data,
            'errors' => $this->errors
        ];
    }

    abstract protected function rules();
}