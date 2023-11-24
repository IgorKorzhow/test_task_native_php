<?php

namespace Kernel\Components\Validation\Rules;

class MaxLength extends AbstractValidationRule
{
    private int $maxLength;

    public function validate(string $fieldName, mixed $value): bool
    {
        if (strlen($value) <= $this->maxLength) {
            return true;
        }

        $this->message = 'This field ' . $fieldName . 'must be shorter then ' . $this->maxLength;

        return false;
    }

    public function setMaxLength(int $maxLength): static
    {
        $this->maxLength = $maxLength;

        return $this;
    }
}