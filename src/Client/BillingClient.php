<?php

namespace AbacatePay\Client;

use AbacatePay\Resources\Billing;

class BillingClient extends Client
{
    const URI = 'billing';

    public function __construct()
    {
        parent::__construct(self::URI);
    }
    
    public function list(): array
    {
        $response = $this->request("GET", "list");
        return array_map(fn($data) => new Billing($data), $response);
    }

    public function create(Billing $data)
    {
        $hasCustomerId = isset($data->customer->id);

        $response = $this->request("POST", "create", [
            'json' => [
                'frequency' => $data->frequency,
                'methods' => $data->methods,
                'products' => $data->products,
                'returnUrl' => $data->metadata->return_url,
                'completionUrl' => $data->metadata->completion_url,
                'products' => array_map(fn($product) => [
                    'externalId' => $product->external_id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'quantity' => $product->quantity,
                    'price' => $product->price
                ], $data->products),
                'customerId' => $hasCustomerId ? $data->customer->id : null,
                'customer' => !$hasCustomerId ? [
                    'name' => $data->customer->name,
                    'email' => $data->customer->email,
                    'cellphone' => $data->customer->cellphone,
                    'taxId' => $data->customer->tax_id
                ] : null
            ]
        ]);

        return new Billing($response);
    }
}