<?php

namespace AbacatePay\Resources;

use DateTime;

/**
 * Base class for resources in the AbacatePay system.
 *
 * This class provides utility methods for initializing resource objects, enums, and handling
 * property mapping between camelCase and snake_case.
 */
class Resource
{
    /**
     * Initializes a DateTime object from a string or DateTime instance.
     *
     * @param string|DateTime $value The value to initialize as a DateTime.
     * @return DateTime|null The initialized DateTime object or null if the value is empty.
     */
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

    /**
     * Initializes an enum instance from a string or object.
     *
     * @param string $enum The enum class name.
     * @param string|object $value The value to initialize as an enum instance.
     * @return object|null The initialized enum instance or null if the value is invalid.
     */
    protected function __initializeEnum(string $enum, string|object $value): ?object
    {
        if ($value instanceof $enum) {
            return $value;
        }

        return $enum::from($value);
    }

    /**
     * Initializes a resource object from an array or object.
     *
     * @param string $resource The resource class name.
     * @param array|object $value The value to initialize as a resource object.
     * @return object|null The initialized resource object or null if the value is invalid.
     */
    protected function __initializeResource(string $resource, array|object $value): ?object
    {
        if ($value instanceof $resource) {
            return $value;
        }

        return new $resource($value);
    }

    /**
     * Fills a resource object with data from an associative array.
     *
     * @param object $class The resource object to fill.
     * @param array $data The data to populate into the resource object.
     * @return void
     */
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

    /**
     * Converts a camelCase string to snake_case.
     *
     * @param string $input The camelCase string to convert.
     * @return string The converted snake_case string.
     */
    protected function __camelToSnakeCase(string $input): string
    {
        $snake = preg_replace('/([a-z0-9])([A-Z])/', '$1_$2', $input);
        $snake = preg_replace('/([A-Z])([A-Z][a-z])/', '$1_$2', $snake);
        return strtolower($snake);
    }
}