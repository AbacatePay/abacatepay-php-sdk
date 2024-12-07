<?php

use AbacatePay\Clients\CustomerClient;
use AbacatePay\Resources\Customer;
use AbacatePay\Resources\Customer\Metadata;

test('Get list of customers', function () {
    $fakeClient = getListCustomersResponseClient();

    $customerClient = new CustomerClient($fakeClient);

    expect($customerClient->list())->toBeArray()->toContainOnlyInstancesOf(Customer::class);
});

test('Create a customer', function () {
    $customer = new Customer([
        'metadata' => new Metadata([
            'name' => 'Abacate Lover',
            'cellphone' => '01912341234',
            'email' => 'lover@abacate.com',
            'tax_id' => '13827826837'
        ])
    ]);
    
    $fakeClient = getCreateCustomerResponseClient();

    $customerClient = new CustomerClient($fakeClient);

    expect($customerClient->create($customer))->toBeInstanceOf(Customer::class);
});