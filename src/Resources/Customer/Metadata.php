<?php

namespace AbacatePay\Resources\Customer;

use AbacatePay\Resources\Resource;

class Metadata extends Resource
{
    public ?string $name;
    public ?string $cellphone;
    public ?string $email;
    public ?string $tax_id;
    
    public function __construct(array $data)
    {
        $this->__fill($this, $data);
    }
}