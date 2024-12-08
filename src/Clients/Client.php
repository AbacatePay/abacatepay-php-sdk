<?php

namespace AbacatePay\Clients;

use Exception;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use Throwable;

/**
 * Client class for interacting with the AbacatePay API.
 *
 * This class handles API requests using GuzzleHttp and provides a way to manage
 * authentication and communication with the AbacatePay service.
 */
class Client
{
    /**
     * Guzzle HTTP client instance.
     *
     * @var GuzzleHttpClient
     */
    private GuzzleHttpClient $client;

    /**
     * API authentication token.
     *
     * @var string|null
     */
    protected static ?string $token;

    /**
     * Base URI for the AbacatePay API.
     */
    const BASE_URI = 'https://api.abacatepay.com/v1';

    /**
     * Constructor for the Client class.
     *
     * @param string $uri The specific API endpoint to interact with.
     * @param GuzzleHttpClient|null $client Optional GuzzleHttpClient instance for custom configurations.
     */
    public function __construct(string $uri, GuzzleHttpClient $client = null)
    {
        $this->client = $client ?? new GuzzleHttpClient([
            'base_uri' => self::BASE_URI . "/" . $uri . "/",
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . self::$token
            ]
        ]);
    }

    /**
     * Sends an HTTP request to the API.
     *
     * @param string $method The HTTP method (e.g., GET, POST).
     * @param string $uri The endpoint URI relative to the base URI.
     * @param array $options Optional settings and parameters for the request.
     * @return array The response data as an associative array.
     * @throws Exception If an error occurs during the request.
     */
    public function request(string $method, string $uri, array $options = []): array
    {
        try {
            return json_decode($this->client->request($method, $uri, $options)->getBody(), true)["data"];
        } catch (RequestException $e) {
            $errorMessage = null;

            if ($e->hasResponse()) {
                $errorResponse = json_decode($e->getResponse()->getBody());
                $errorMessage = $errorResponse->message ?? $errorResponse->error;
            }

            throw new Exception("Request error: " . $errorMessage ?? $e->getMessage(), $e->getCode());
        } catch (Throwable $e) {
            throw new Exception("Unexpected error: " . $e->getMessage(), $e->getCode());
        }
    }

    /**
     * Sets the API authentication token.
     *
     * @param string $token The API token to authenticate requests.
     */
    public static function setToken(string $token): void
    {
        self::$token = $token;
    }
}