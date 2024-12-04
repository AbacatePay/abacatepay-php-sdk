<?php

namespace AbacatePay\Resources;

use AbacatePay\Enums\Billing\Frequencies;
use AbacatePay\Enums\Billing\Methods;
use AbacatePay\Enums\Billing\Statuses;
use AbacatePay\Enums\BillingFrequencies;
use AbacatePay\Enums\BillingStatuses;
use AbacatePay\Resources\Billing\Metadata;
use AbacatePay\Resources\Billing\Product;
use DateTime;

class Billing extends Resource
{
    public ?string $id;
    public ?string $account_id;
    public ?string $url;
    public ?array $methods;
    public ?array $products;
    public ?bool $dev_mode;
    public ?int $amount;
    public ?Metadata $metadata;
    public ?Frequencies $frequency;
    public ?Statuses $status;
    public ?DateTime $next_billing;
    public ?DateTime $created_at;
    public ?DateTime $updated_at;

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
            case 'products':
                return array_map(fn($product) => $this->__initializeResource(Product::class, $product), $value);
            case 'methods':
                return array_map(fn($method) => $this->__initializeEnum(Methods::class, $method), $value);
            default:
                return $value;
        }
    }
}