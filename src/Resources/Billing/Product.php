<?php

namespace AbacatePay\Resources\Billing;

use AbacatePay\Resources\Resource;

/**
 * Represents a product in a billing resource in the AbacatePay system.
 *
 * This class contains information about a product, such as its identifier, name, description,
 * quantity, and price.
 */
class Product extends Resource
{
    /**
     * External identifier for the product.
     *
     * @var string|null
     */
    public ?string $external_id;

    /**
     * Internal identifier for the product in the system.
     *
     * @var string|null
     */
    public ?string $product_id;

    /**
     * Name of the product.
     *
     * @var string|null
     */
    public ?string $name;

    /**
     * Description of the product.
     *
     * @var string|null
     */
    public ?string $description;

    /**
     * Quantity of the product.
     *
     * @var int|null
     */
    public ?int $quantity;

    /**
     * Price of the product in the smallest currency unit (e.g., cents).
     *
     * @var int|null
     */
    public ?int $price;

    /**
     * Constructor for the Product class.
     *
     * Initializes the Product object with the provided data.
     *
     * @param array $data An associative array of product properties.
     */
    public function __construct(array $data)
    {
        $this->__fill($this, $data);
    }
}