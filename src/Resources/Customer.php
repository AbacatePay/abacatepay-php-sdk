<?php

namespace AbacatePay\Resources;

use AbacatePay\Resources\Resource;

class Customer extends Resource
{
    public ?string $id;
    public ?string $name;
    public ?string $cellphone;
    public ?string $email;
    public ?string $tax_id;

    public function __construct(array $data)
    {
        $this->__fill($this, $data);
    }
}