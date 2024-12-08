<?php

namespace AbacatePay\Resources\Billing;

use AbacatePay\Resources\Resource;

/**
 * Represents metadata for a billing resource in the AbacatePay system.
 *
 * This class contains additional information related to a billing resource,
 * such as fee, return URL, and completion URL.
 */
class Metadata extends Resource
{
    /**
     * Fee associated with the billing.
     *
     * @var int|null
     */
    public ?int $fee;

    /**
     * URL to redirect the user after payment is canceled or abandoned.
     *
     * @var string|null
     */
    public ?string $return_url;

    /**
     * URL to redirect the user after successful payment.
     *
     * @var string|null
     */
    public ?string $completion_url;

    /**
     * Constructor for the Metadata class.
     *
     * Initializes the Metadata object with the provided data.
     *
     * @param array $data An associative array of metadata properties.
     */
    public function __construct(array $data)
    {
        $this->__fill($this, $data);
    }
}