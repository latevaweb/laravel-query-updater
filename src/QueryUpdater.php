<?php

namespace LaTevaWeb\QueryUpdater;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use LaTevaWeb\QueryUpdater\Field\AbstractField;
use LaTevaWeb\QueryUpdater\Field\SimpleField;

class QueryUpdater
{
    protected $allowedFields;
    protected $data;
    protected $model;

    private function __construct(Model $model, $request = null)
    {
        $this->model = $model;

        $this->data = $this->requestToData($request);
    }

    private function requestToData($request): array
    {
        if ($request instanceof Request) {
            return $request->all();
        }

        if (is_array($request)) {
            return $request;
        }

        return [];
    }

    public static function for(Model $model, $request = null): self
    {
        return new static($model, $request ?? request());
    }

    public function updateFields(array $fields = [])
    {
        $fields = $this->composeFields($fields);

        $fields->each(function ($field) {
            if ($this->fieldExists($field->getName()) && $this->allowedField($field->getName())) {
                $this->model->{$field->getName()} = $field->getValue();
            }
        });

        return $this->model;
    }

    private function allowedField(string $name = null): bool
    {
        return in_array($name, $this->allowedFields);
    }

    private function fieldExists(string $name = null): bool
    {
        return $this->model
            ->getConnection()
            ->getSchemaBuilder()
            ->hasColumn($this->model->getTable(), $name);
    }

    /**
     * Compose array of fields (string or object) to array of AbstractField objects.
     *
     * @param array
     *
     * @return Collection
     */
    private function composeFields(array $fields = []): Collection
    {
        return collect($fields)
            ->flatten()
            ->map(function ($field) {
                if (empty($field)) {
                    return false;
                } else {
                    if (is_string($field)) {
                        $this->setAllowedField($field);

                        return SimpleField::field($field, $this->getDataValue($field));
                    }

                    $this->setAllowedField($field->getName());
                    $field->setValue($this->getDataValue($field->getName()));
                    $field->setStoredValue($this->model->{$field->getName()});

                    return $field;
                }
            })
            ->filter(function ($field) {
                return $field instanceof AbstractField;
            });
    }

    private function getDataValue($name)
    {
        return $this->data[$name] ?? null;
    }

    private function setAllowedField($name)
    {
        $this->allowedFields[] = $name;
    }
}
