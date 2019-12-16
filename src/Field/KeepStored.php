<?php

namespace LaTevaWeb\QueryUpdater\Field;

class KeepStored extends AbstractField
{
    public function getValue()
    {
        return (is_null($this->value) || empty($this->value)) ? $this->getStoredValue() : $this->value;
    }

    public function setValue($value = null): void
    {
        $this->value = (is_null($value) || empty($value)) ? $this->getStoredValue() : $value;
    }
}
