<?php

namespace AbacatePay\Enums\Billing;

/**
 * Enumeration defining billing methods.
 *
 * This enumeration is used to represent different payment methods available for billing.
 */
enum Methods: string
{
    /**
     * PIX payment method.
     *
     * Represents the PIX payment method, a popular instant payment system in Brazil.
     */
    case PIX = "PIX";
}