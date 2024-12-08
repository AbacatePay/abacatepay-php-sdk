<?php

namespace AbacatePay\Enums\Billing;

/**
 * Enumeration defining billing frequencies.
 *
 * This enumeration is used to categorize different payment or billing frequencies.
 */
enum Frequencies: string
{
    /**
     * One-time billing.
     *
     * Represents a billing that occurs only once.
     */
    case ONE_TIME = "ONE_TIME";
}