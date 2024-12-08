<?php

namespace AbacatePay\Resources;

use AbacatePay\Resources\Customer\Metadata;
use AbacatePay\Resources\Resource;

/**
 * Represents a customer resource in the AbacatePay system.
 *
 * This class contains information about a customer, including their metadata.
 */
class Customer extends Resource
{
    /**
     * Unique identifier for the customer.
     *
     * @var string|null
     */
    public ?string $id;

    /**
     * Metadata associated with the customer.
     *
     * @var Metadata|null
     */
    public ?Metadata $metadata;

    /**
     * Constructor for the Customer class.
     *
     * Initializes the Customer object with the provided data.
     *
     * @param array $data Associative array of customer properties.
     */
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $this->__set($key, $value);
        }
    }

    /**
     * Dynamically sets a property value after processing it.
     *
     * @param string $name The name of the property to set.
     * @param mixed $value The value to set for the property.
     */
    public function __set($name, $value)
    {
        $name = $this->__camelToSnakeCase($name);

        if (!property_exists($this, $name)) {
            return;
        }

        $this->{$name} = $this->processValue($name, $value);
    }

    /**
     * Processes the value of a property based on its type and context.
     *
     * @param string $name The name of the property.
     * @param mixed $value The value to process.
     * @return mixed The processed value.
     */
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