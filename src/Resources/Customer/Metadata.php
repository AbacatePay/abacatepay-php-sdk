<?php

namespace AbacatePay\Resources\Customer;

use AbacatePay\Resources\Resource;

/**
 * Represents metadata for a customer in the AbacatePay system.
 *
 * This class contains additional information about a customer, such as their name,
 * contact details, and tax identification number.
 */
class Metadata extends Resource
{
    /**
     * Customer's name.
     *
     * @var string|null
     */
    public ?string $name;

    /**
     * Customer's cellphone number.
     *
     * @var string|null
     */
    public ?string $cellphone;

    /**
     * Customer's email address.
     *
     * @var string|null
     */
    public ?string $email;

    /**
     * Customer's tax identification number.
     *
     * @var string|null
     */
    public ?string $tax_id;
    
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