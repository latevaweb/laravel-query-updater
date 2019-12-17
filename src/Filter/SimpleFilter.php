<?php

namespace LaTevaWeb\QueryUpdater\Filter;

class SimpleFilter extends AbstractField
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
