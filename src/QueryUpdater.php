<?php

namespace Mguinea\QueryUpdater;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class QueryUpdater
{
    protected $model;
    protected $data;

    private function __construct(Model $model, $request = null)
    {
        $this->model = $model;

        $this->data = $this->toData($request);
    }

    private function toData($request): array
    {
        if($request instanceof Request) {
            return $request->all();
        }

        if(is_array($request)) {
            return $request;
        }

        return [];
    }

    public static function for(Model $model, $request = null): self
    {
        return new static($model, $request ?? request());
    }

    public function updateFields($fields)
    {
        $fields = collect($fields);

        $fields->each(function($field) {
            if($this->fieldExists($field)) {
                $this->model->{$field} = $this->data[$field];
            }
        });

        return $this->model;
    }

    private function fieldExists($field): bool
    {
        return $this->model
            ->getConnection()
            ->getSchemaBuilder()
            ->hasColumn($this->model->getTable(), $field);
    }
}