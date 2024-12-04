<?php

namespace AbacatePay\Resources\Billing;

use AbacatePay\Resources\Resource;

class Product extends Resource
{
    public ?string $external_id;
    public ?string $product_id;
    public ?string $name;
    public ?string $description;
    public ?int $quantity;
    public ?int $price;

    public function __construct(array $data)
    {
        $this->__fill($this, $data);
    }
}