<?php

use AbacatePay\Clients\BillingClient;
use AbacatePay\Enums\Billing\Frequencies;
use AbacatePay\Enums\Billing\Methods;
use AbacatePay\Resources\Billing;
use AbacatePay\Resources\Billing\Metadata as BillingMetadata;
use AbacatePay\Resources\Customer\Metadata as CustomerMetadata;
use AbacatePay\Resources\Billing\Product;
use AbacatePay\Resources\Customer;

test('Get list of billings', function () {
    $billingClient = new BillingClient();
    $billingClient->list();
});

test('Create a billing', function () {
    $billing = new Billing([
        'frequency' => Frequencies::ONE_TIME,
        'methods' => [ Methods::PIX ],
        'products' => [
            new Product([
                'external_id' => 'abc_123',
                'name' => 'Produto A',
                'description' => 'Descrição do produto A',
                'quantity' => 1,
                'price' => 100
            ])
        ],
        'metadata' => new BillingMetadata([
            'return_url' => 'https://www.abacatepay.com',
            'completion_url' => 'https://www.abacatepay.com'
        ]),
        'customer' => new Customer([
            'metadata' => new CustomerMetadata([
                'name' => 'Abacate Lover',
                'cellphone' => '01912341234',
                'email' => 'lover@abacate.com',
                'tax_id' => '13827826837'
            ])
        ])
    ]);
    
    $billingClient = new BillingClient();
    $billingClient->create($billing);
});