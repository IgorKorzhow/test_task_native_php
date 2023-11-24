<?php

namespace Kernel\Components\Validation\Rules;

class StringRule extends AbstractValidationRule
{

    public function validate(string $fieldName, $value): bool
    {
        if (is_string($value)) {
            return true;
        }

        $this->message = 'This field must be a string: ' . $fieldName;

        return false;
    }
}