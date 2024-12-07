<?php

namespace AbacatePay\Clients;

use AbacatePay\Resources\Customer;

class CustomerClient extends Client
{
    const URI = 'customer';

    public function __construct()
    {
        parent::__construct(self::URI);
    }
    
    public function list(): array
    {
        $response = $this->request("GET", "list");
        return array_map(fn($data) => new Customer($data), $response);
    }

    public function create(Customer $data): Customer
    {
        $response = $this->request("POST", "create", [
            'json' => [
                'name' => $data->metadata->name,
                'email' => $data->metadata->email,
                'cellphone' => $data->metadata->cellphone,
                'taxId' => $data->metadata->tax_id
            ]
        ]);

        return new Customer($response);
    }
}