<?php

use AbacatePay\Client\BillingClient;
use AbacatePay\Enums\Billing\Frequencies;
use AbacatePay\Enums\Billing\Methods;
use AbacatePay\Resources\Billing;
use AbacatePay\Resources\Billing\Metadata;
use AbacatePay\Resources\Billing\Product;

// test('Get list of billings', function () {
//     $billingClient = new BillingClient();
//     $billingClient->list();
// });

// test('Get list of billings', function () {
//     $billing = new Billing([
//         'frequency' => Frequencies::ONE_TIME,
//         'methods' => [ Methods::PIX ],
//         'products' => [
//             new Product([
//                 'external_id' => 'abc_123',
//                 'name' => 'Produto A',
//                 'description' => 'Descrição do produto A',
//                 'quantity' => 1,
//                 'price' => 100
//             ])
//         ],
//         'metadata' => new Metadata([
//             'return_url' => 'https://www.abacatepay.com',
//             'completion_url' => 'https://www.abacatepay.com'
//         ])
//     ]);
    
//     $billingClient = new BillingClient();
//     $billingClient->create($billing);
// });