<?php

namespace AbacatePay\Resources;

use AbacatePay\Enums\Billing\Frequencies;
use AbacatePay\Enums\Billing\Methods;
use AbacatePay\Enums\Billing\Statuses;
use AbacatePay\Resources\Billing\Metadata;
use AbacatePay\Resources\Billing\Product;
use DateTime;

/**
 * Represents a billing resource in the AbacatePay system.
 *
 * This class contains information about a billing entity, including metadata, customer details,
 * payment methods, products, and billing frequency.
 */
class Billing extends Resource
{
    /**
     * Unique identifier for the billing.
     *
     * @var string|null
     */
    public ?string $id;

    /**
     * Identifier for the associated account.
     *
     * @var string|null
     */
    public ?string $account_id;

    /**
     * URL for accessing the billing resource.
     *
     * @var string|null
     */
    public ?string $url;

    /**
     * Array of payment methods available for the billing.
     *
     * @var Methods[]|null
     */
    public ?array $methods;

    /**
     * Array of products associated with the billing.
     *
     * @var Product[]|null
     */
    public ?array $products;

    /**
     * Indicates whether the billing is in development mode.
     *
     * @var bool|null
     */
    public ?bool $dev_mode;

    /**
     * Total amount of the billing in the smallest currency unit (e.g., cents).
     *
     * @var int|null
     */
    public ?int $amount;

    /**
     * Metadata associated with the billing.
     *
     * @var Metadata|null
     */
    public ?Metadata $metadata;

    /**
     * Frequency of the billing.
     *
     * @var Frequencies|null
     */
    public ?Frequencies $frequency;

    /**
     * Current status of the billing.
     *
     * @var Statuses|null
     */
    public ?Statuses $status;

    /**
     * Customer associated with the billing.
     *
     * @var Customer|null
     */
    public ?Customer $customer;

    /**
     * Date and time of the next billing.
     *
     * @var DateTime|null
     */
    public ?DateTime $next_billing;

    /**
     * Date and time when the billing was created.
     *
     * @var DateTime|null
     */
    public ?DateTime $created_at;

    /**
     * Date and time when the billing was last updated.
     *
     * @var DateTime|null
     */
    public ?DateTime $updated_at;

    /**
     * Constructor for the Billing class.
     *
     * Initializes the Billing object with the provided data.
     *
     * @param array $data Associative array of billing properties.
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
            case 'next_billing':
            case 'created_at':
            case 'updated_at':
                return $this->__initializeDateTime($value);
            case 'status':
                return $this->__initializeEnum(Statuses::class, $value);
            case 'frequency':
                return $this->__initializeEnum(Frequencies::class, $value);
            case 'metadata':
                return $this->__initializeResource(Metadata::class, $value);
            case 'customer':
                return $this->__initializeResource(Customer::class, $value);
            case 'products':
                return array_map(fn($product) => $this->__initializeResource(Product::class, $product), $value);
            case 'methods':
                return array_map(fn($method) => $this->__initializeEnum(Methods::class, $method), $value);
            default:
                return $value;
        }
    }
}