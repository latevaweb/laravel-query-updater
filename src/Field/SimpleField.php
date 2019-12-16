<?php

namespace LaTevaWeb\QueryUpdater\Field;

class SimpleField extends AbstractField
{
    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value = null): void
    {
        $this->value = $value;
    }
}