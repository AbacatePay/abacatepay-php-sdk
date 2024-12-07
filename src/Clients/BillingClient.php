<?php

namespace AbacatePay\Clients;

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

    public function create(Billing $data): Billing
    {
        $requestData = [
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
        ];

        if (!isset($data->customer->id)) {
            $requestData['customer'] = [
                'name' => $data->customer->metadata->name,
                'email' => $data->customer->metadata->email,
                'cellphone' => $data->customer->metadata->cellphone,
                'taxId' => $data->customer->metadata->tax_id
            ];
        } else {
            $requestData['customerId'] = $data->customer->id;
        }


        $response = $this->request("POST", "create", [
            'json' => $requestData
        ]);

        return new Billing($response);
    }
}