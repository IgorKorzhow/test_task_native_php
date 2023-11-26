<?php

namespace Kernel\Components\Validation;

use Kernel\Components\Validation\Rules\AbstractValidationRule;

abstract class AbstractValidator
{
    protected array $errors = [];
    public array $data = [];

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

        $result = [
            'data' => $this->data,
            'errors' => $this->errors
        ];

        if (count($this->errors) > 0) {
            $_SESSION['data'] = $result;
            header('Location:' . $_SERVER['HTTP_REFERER']);
            die();
        }

        return $result['data'];
    }

    abstract protected function rules();
}