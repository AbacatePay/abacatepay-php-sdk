<?php

namespace AbacatePay\Resources;

use AbacatePay\Resources\Customer\Metadata;
use AbacatePay\Resources\Resource;

class Customer extends Resource
{
    public ?string $id;
    public ?Metadata $metadata;

    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $this->__set($key, $value);
        }
    }

    public function __set($name, $value)
    {
        $name = $this->__camelToSnakeCase($name);

        if (!property_exists($this, $name)) {
            return;
        }

        $this->{$name} = $this->processValue($name, $value);
    }

    private function processValue($name, $value)
    {
        if ($value === null) {
            return null;
        }

        switch ($name) {
            case 'metadata':
                return $this->__initializeResource(Metadata::class, $value);
            default:
                return $value;
        }
    }
}