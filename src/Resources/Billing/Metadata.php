<?php

namespace AbacatePay\Resources\Billing;

use AbacatePay\Resources\Resource;

class Metadata extends Resource
{
    public ?int $fee;
    public ?string $return_url;
    public ?string $completion_url;
    
    public function __construct(array $data)
    {
        $this->__fill($this, $data);
    }
}