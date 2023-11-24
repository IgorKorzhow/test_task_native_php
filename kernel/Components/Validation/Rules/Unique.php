<?php

namespace Kernel\Components\Validation\Rules;

use RuntimeException;

class Unique extends AbstractValidationRule
{
    public ?string $table;

    /**
     * @throws RuntimeException
     */
    public function validate(string $fieldName, $value): bool
    {
        if ($this->table === null) {
            throw new RuntimeException('Unique constraint must know table name');
        }


        $this->message = 'This field: ' . $fieldName . ' is required';

        return false;
    }

    public function setTable(string $table): void
    {
        $this->table = $table;
    }
}