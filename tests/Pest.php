<?php

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

function createMockClient(string $responseFilePath): Client
{
    $handler = new MockHandler();

    $handler->append(
        new Response(
            status: 200,
            body: file_get_contents(__DIR__ . '/Mocks/Response/' . $responseFilePath . '.json')
        )
    );

    return new Client([
        'handler' => $handler
    ]);
}

function getListBillingsResponseClient() {
    return createMockClient('Billing/list');
}

function getCreateBillingResponseClient() {
    return createMockClient('Billing/create');
}

function getListCustomersResponseClient() {
    return createMockClient('Customer/list');
}

function getCreateCustomerResponseClient() {
    return createMockClient('Customer/create');
}