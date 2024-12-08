<?php

namespace AbacatePay\Enums\Billing;

/**
 * Enumeration defining billing statuses.
 *
 * This enumeration is used to represent the various statuses that a billing process can have.
 */
enum Statuses: string
{
    /**
     * Pending status.
     *
     * Indicates that the billing is pending and has not yet been processed.
     */
    case PENDING = "PENDING";

    /**
     * Expired status.
     *
     * Indicates that the billing has expired and is no longer valid.
     */
    case EXPIRED = "EXPIRED";

    /**
     * Cancelled status.
     *
     * Indicates that the billing has been cancelled and will not be processed.
     */
    case CANCELLED = "CANCELLED";

    /**
     * Paid status.
     *
     * Indicates that the billing has been successfully paid.
     */
    case PAID = "PAID";

    /**
     * Refunded status.
     *
     * Indicates that the billing has been refunded to the payer.
     */
    case REFUNDED = "REFUNDED";
}