<?php

namespace AbacatePay\Clients;

use Exception;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;

class Client
{
    private GuzzleHttpClient $client;
    
    protected static $token;

    const BASE_URI = 'https://api.abacatepay.com/v1';

    public function __construct(string $uri)
    {
        $this->client = new GuzzleHttpClient([
            'base_uri' => self::BASE_URI . "/" . $uri . "/",
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . self::$token
            ]
        ]);
    }
    
    public function request(string $method, string $uri, array $options = []): array
    {
        try {
            return json_decode($this->client->request($method, $uri, $options)->getBody(), true)["data"];
        } catch (RequestException $e) {
            $errorMessage = null;

            if ($e->hasResponse()) {
                $errorResponse = json_decode($e->getResponse()->getBody());
                $errorMessage = $errorResponse->error;
            }

            throw new Exception("Request error: " . $errorMessage ?? $e->getMessage(), $e->getCode());
        }
    }

    public static function setToken(string $token): void
    {
        self::$token = $token;
    }
}