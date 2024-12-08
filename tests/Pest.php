<?php

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

/**
 * Creates a mock Guzzle HTTP client for testing purposes.
 *
 * This function sets up a Guzzle client with a mocked handler that returns a predefined JSON response
 * from a file. The file path is relative to the `Mocks/Response` directory.
 *
 * @param string $responseFilePath The relative path (excluding `.json`) to the mock response file.
 * @return Client The Guzzle HTTP client with the mock handler.
 */
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

/**
 * Creates a mock client with a predefined response for listing billings.
 *
 * @return Client The mock Guzzle HTTP client.
 */
function getListBillingsResponseClient(): Client
{
    return createMockClient('Billing/list');
}

/**
 * Creates a mock client with a predefined response for creating a billing.
 *
 * @return Client The mock Guzzle HTTP client.
 */
function getCreateBillingResponseClient(): Client
{
    return createMockClient('Billing/create');
}

/**
 * Creates a mock client with a predefined response for listing customers.
 *
 * @return Client The mock Guzzle HTTP client.
 */
function getListCustomersResponseClient(): Client
{
    return createMockClient('Customer/list');
}

/**
 * Creates a mock client with a predefined response for creating a customer.
 *
 * @return Client The mock Guzzle HTTP client.
 */
function getCreateCustomerResponseClient(): Client
{
    return createMockClient('Customer/create');
}