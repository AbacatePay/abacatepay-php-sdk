<?php

use AbacatePay\Clients\CustomerClient;
use AbacatePay\Resources\Customer;
use AbacatePay\Resources\Customer\Metadata;

/**
 * Test case: Retrieve a list of customers.
 *
 * This test verifies that the `list` method of `CustomerClient` correctly retrieves
 * an array of `Customer` instances.
 */
test('Get list of customers', function () {
    // Mocked client with a fake response for listing customers
    $fakeClient = getListCustomersResponseClient();

    // Create a CustomerClient instance using the mocked client
    $customerClient = new CustomerClient($fakeClient);

    // Assert that the response is an array containing only Customer instances
    expect($customerClient->list())->toBeArray()->toContainOnlyInstancesOf(Customer::class);
});

/**
 * Test case: Create a new customer.
 *
 * This test verifies that the `create` method of `CustomerClient` successfully creates
 * a `Customer` instance when valid data is provided.
 */
test('Create a customer', function () {
    // Create a new Customer object with required metadata
    $customer = new Customer([
        'metadata' => new Metadata([
            'name' => 'Abacate Lover',
            'cellphone' => '01912341234',
            'email' => 'lover@abacate.com',
            'tax_id' => '13827826837'
        ])
    ]);
    
    // Mocked client with a fake response for creating a customer
    $fakeClient = getCreateCustomerResponseClient();

    // Create a CustomerClient instance using the mocked client
    $customerClient = new CustomerClient($fakeClient);

    // Assert that the `create` method returns a Customer instance
    expect($customerClient->create($customer))->toBeInstanceOf(Customer::class);
});