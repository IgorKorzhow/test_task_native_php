<?php

namespace Kernel\Components\Validation\Rules;

use Kernel\Components\DBConnection;
use RuntimeException;

class Unique extends AbstractValidationRule
{
    private ?string $table;

    /**
     * @throws RuntimeException
     */
    public function validate(string $fieldName, $value): bool
    {
        if ($this->table === null) {
            throw new RuntimeException('Unique constraint must know table name');
        }

        if (!$this->checkExistence($fieldName, $value)) {
            return true;
        }

        $this->message = 'This field: ' . $fieldName . ' with value: ' . $value . ' already exists';

        return false;
    }

    public function setTable(string $table): static
    {
        $this->table = $table;

        return $this;
    }

    private function checkExistence(string $field, string $value): bool
    {
        $dbConnection = DBConnection::getInstance();

        $sql = <<<SQL
            SELECT *
            FROM {$this->table}
            WHERE {$field} = :value
        SQL;

        $preparedRequest = $dbConnection->prepare($sql);

        $preparedRequest->execute([
            'value' => $value,
        ]);

        return (bool)$preparedRequest->fetch();
    }
}