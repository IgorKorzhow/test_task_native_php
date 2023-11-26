<?php

namespace Kernel\Components\Model;

abstract class AbstractModel
{
    public function initializeModel($data): static
    {
        foreach ($data as $fieldName => $value) {
            $this->$fieldName = $value;
        }

        return $this;
    }
}