<?php

namespace AbacatePay\Clients;

use AbacatePay\Resources\Billing;
use GuzzleHttp\Client as GuzzleHttpClient;

/**
 * Client class for managing billing-related operations in the AbacatePay API.
 *
 * This class provides methods to list and create billings, utilizing the base Client functionality.
 */
class BillingClient extends Client
{
    /**
     * API endpoint for billing-related operations.
     */
    const URI = 'billing';

    /**
     * Constructor for the BillingClient class.
     *
     * Initializes the client for the billing endpoint.
     *
     * @param GuzzleHttpClient|null $client Optional GuzzleHttpClient instance for custom configurations.
     */
    public function __construct(GuzzleHttpClient $client = null)
    {
        parent::__construct(self::URI, $client);
    }
    
    /**
     * Retrieves a list of billings.
     *
     * Sends a GET request to the "list" endpoint and returns an array of Billing objects.
     *
     * @return Billing[] An array of Billing objects representing the billings retrieved.
     */
    public function list(): array
    {
        $response = $this->request("GET", "list");
        return array_map(fn($data) => new Billing($data), $response);
    }

    /**
     * Creates a new billing.
     *
     * Sends a POST request to the "create" endpoint with the billing data and returns the created Billing object.
     *
     * @param Billing $data The billing data to be sent for creation.
     * @return Billing The created Billing object.
     */
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