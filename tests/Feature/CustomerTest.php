<?php

use AbacatePay\Clients\CustomerClient;
use AbacatePay\Resources\Customer;
use AbacatePay\Resources\Customer\Metadata;

test('Get list of customers', function () {
    $customerClient = new CustomerClient();
    $customerClient->list();
});

test('Create a customer', function () {
    $customerClient = new CustomerClient();
    $customerClient->create(new Customer([
        'metadata' => new Metadata([
            'name' => 'Abacate Lover',
            'cellphone' => '01912341234',
            'email' => 'lover@abacate.com',
            'tax_id' => '13827826837'
        ])
    ]));
});