<?php

namespace Kernel\Components\Validation\Rules;

abstract class AbstractValidationRule
{
    public string $message;

    abstract public function validate(string $fieldName, mixed $value): bool;
}