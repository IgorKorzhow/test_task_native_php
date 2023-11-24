<?php

namespace Kernel\Components\Validation\Rules;

class Required extends AbstractValidationRule
{
    public function validate(string $fieldName, $value): bool
    {
        if (!empty($value)) {
            return true;
        }

        $this->message = 'This field: ' . $fieldName . ' is required';

        return false;
    }
}