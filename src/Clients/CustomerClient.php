<?php

namespace AbacatePay\Clients;

use AbacatePay\Resources\Customer;
use GuzzleHttp\Client as GuzzleHttpClient;

/**
 * Client class for managing customer-related operations in the AbacatePay API.
 *
 * This class provides methods to list and create customers, utilizing the base Client functionality.
 */
class CustomerClient extends Client
{
    /**
     * API endpoint for customer-related operations.
     */
    const URI = 'customer';

    /**
     * Constructor for the CustomerClient class.
     *
     * Initializes the client for the customer endpoint.
     *
     * @param GuzzleHttpClient|null $client Optional GuzzleHttpClient instance for custom configurations.
     */
    public function __construct(GuzzleHttpClient $client = null)
    {
        parent::__construct(self::URI, $client);
    }
    
    /**
     * Retrieves a list of customers.
     *
     * Sends a GET request to the "list" endpoint and returns an array of Customer objects.
     *
     * @return Customer[] An array of Customer objects representing the customers retrieved.
     */
    public function list(): array
    {
        $response = $this->request("GET", "list");
        return array_map(fn($data) => new Customer($data), $response);
    }

    /**
     * Creates a new customer.
     *
     * Sends a POST request to the "create" endpoint with the customer data and returns the created Customer object.
     *
     * @param Customer $data The customer data to be sent for creation.
     * @return Customer The created Customer object.
     */
    public function create(Customer $data): Customer
    {
        $response = $this->request("POST", "create", [
            'json' => [
                'name' => $data->metadata->name,
                'email' => $data->metadata->email,
                'cellphone' => $data->metadata->cellphone,
                'taxId' => $data->metadata->tax_id
            ]
        ]);

        return new Customer($response);
    }
}