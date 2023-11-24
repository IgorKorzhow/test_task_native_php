<?php

namespace Kernel\Components\Validation\Rules;

class Confirmed extends AbstractValidationRule
{
    private array $confirmationField;

    public function validate(string $fieldName, mixed $value): bool
    {
        if (count($this->confirmationField) > 0 && $value === $this->confirmationField[$fieldName . '_confirmation']) {
            return true;
        }

        $this->message = 'This field ' . $fieldName . 'is not confirmed or doesnt match ';

        return false;
    }

    public function setConfirmationField(array $confirmationField): static
    {
        $this->confirmationField = $confirmationField;

        return $this;
    }
}