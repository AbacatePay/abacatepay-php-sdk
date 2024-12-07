<?php

namespace AbacatePay\Resources;

use DateTime;

class Resource
{
    protected function __initializeDateTime(string|DateTime $value): ?DateTime
    {
        if (!$value) {
            return null;
        }

        if ($value instanceof DateTime) {
            return $value;
        }

        return new DateTime($value);
    }

    protected function __initializeEnum(string $enum, string|object $value): ?object
    {
        if ($value instanceof $enum) {
            return $value;
        }

        return $enum::from($value);
    }

    protected function __initializeResource(string $resource, array|object $value): ?object
    {
        if ($value instanceof $resource) {
            return $value;
        }

        return new $resource($value);
    }

    protected function __fill(object $class, array $data): void
    {
        foreach ($data as $name => $value) {
            $name = $this->__camelToSnakeCase($name);
            
            if (!property_exists($class, $name)) {
                continue;
            }

            $class->{$name} = $value;
        }
    }

    protected function __camelToSnakeCase(string $input): string
    {
        $snake = preg_replace('/([a-z0-9])([A-Z])/', '$1_$2', $input);
        $snake = preg_replace('/([A-Z])([A-Z][a-z])/', '$1_$2', $snake);
        return strtolower($snake);
    }
}