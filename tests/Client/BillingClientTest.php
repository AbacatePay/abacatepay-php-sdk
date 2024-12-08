<?php

use AbacatePay\Clients\BillingClient;
use AbacatePay\Enums\Billing\Frequencies;
use AbacatePay\Enums\Billing\Methods;
use AbacatePay\Resources\Billing;
use AbacatePay\Resources\Billing\Metadata as BillingMetadata;
use AbacatePay\Resources\Customer\Metadata as CustomerMetadata;
use AbacatePay\Resources\Billing\Product;
use AbacatePay\Resources\Customer;

/**
 * Test case: Retrieve a list of billings.
 *
 * This test verifies that the `list` method of `BillingClient` correctly retrieves
 * an array of `Billing` instances.
 */
test('Get list of billings', function () {
    // Mocked client with a fake response for listing billings
    $fakeClient = getListBillingsResponseClient();
    
    // Create a BillingClient instance using the mocked client
    $billingClient = new BillingClient($fakeClient);

    // Assert that the response is an array containing only Billing instances
    expect($billingClient->list())->toBeArray()->toContainOnlyInstancesOf(Billing::class);
});

/**
 * Test case: Create a new billing.
 *
 * This test verifies that the `create` method of `BillingClient` successfully creates
 * a `Billing` instance when valid data is provided.
 */
test('Create a billing', function () {
    // Create a new Billing object with required data
    $billing = new Billing([
        'frequency' => Frequencies::ONE_TIME,
        'methods' => [ Methods::PIX ],
        'products' => [
            new Product([
                'external_id' => 'abc_123',
                'name' => 'Abacate',
                'description' => 'Abacate maduro',
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
    
    // Mocked client with a fake response for creating a billing
    $fakeClient = getCreateBillingResponseClient();

    // Create a BillingClient instance using the mocked client
    $billingClient = new BillingClient($fakeClient);

    // Assert that the `create` method returns a Billing instance
    expect($billingClient->create($billing))->toBeInstanceOf(Billing::class);
});