<?php

namespace LaTevaWeb\QueryUpdater\Filter;

class SimpleFilter extends AbstractFilter
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
