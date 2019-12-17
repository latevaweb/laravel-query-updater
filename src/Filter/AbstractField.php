<?php

namespace LaTevaWeb\QueryUpdater\Filter;

abstract class AbstractField
{
    protected $name;
    protected $value;
    protected $storedValue;

    private function __construct(string $name, $value = null, $storedValue = null)
    {
        $this->setName($name);
        $this->setValue($value);
        $this->setStoredValue($storedValue);
    }

    public static function field(string $name, $value = null, $storedValue = null): self
    {
        return new static($name, $value, $storedValue);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getStoredValue()
    {
        return $this->storedValue;
    }

    /**
     * @param mixed $storedValue
     */
    public function setStoredValue($storedValue): void
    {
        $this->storedValue = $storedValue;
    }

    abstract public function getValue();

    abstract public function setValue($value = null): void;
}
