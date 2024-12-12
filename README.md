# AbacatePay SDK for PHP

A robust PHP SDK for integrating AbacatePay payment solutions into your applications.

## 📋 Requirements

-   PHP 7.2.5 or higher
-   Composer
-   Valid AbacatePay account and API credentials
-   SSL enabled for production environments

## 💻 Installation

Install the SDK via Composer:

```bash
composer require abacatepay/php-sdk
```

## 🔧 Configuration

First, initialize the SDK with your API token:

```php
use AbacatePay\Clients\Client;

Client::setToken($_ENV["ABACATEPAY_TOKEN"]);
```

> ⚠️ Never commit your API tokens to version control. Use environment variables instead.

## 🌟 Features

-   Simple billing management
-   Customer management
-   Multiple payment methods support
-   Webhook handling
-   Secure payment processing
-   Error handling and logging

## 📘 Usage Examples

### Billing Management

Initialize the Billing Client

```php
use AbacatePay\Clients\BillingClient;

$billingClient = new BillingClient();
```

#### List All Billings

```php
$billings = $billingClient->list();
```

#### Create a New Billing

```php
use AbacatePay\Resources\Billing;
use AbacatePay\Resources\Billing\Product;
use AbacatePay\Resources\Billing\Metadata as BillingMetadata;
use AbacatePay\Enums\Billing\Methods;
use AbacatePay\Enums\Billing\Frequencies;
use AbacatePay\Resources\Customer;
use AbacatePay\Resources\Customer\Metadata as CustomerMetadata;

$billing = $billingClient->create(new Billing([
    'frequency' => Frequencies::ONE_TIME,
    'methods' => [Methods::PIX],
    'products' => [
        new Product([
            'external_id' => 'abc_123',
            'name' => 'Product A',
            'description' => 'Description of product A',
            'quantity' => 1,
            'price' => 100 // Price in cents
        ])
    ],
    'metadata' => new BillingMetadata([
        'return_url' => 'https://www.abacatepay.com',
        'completion_url' => 'https://www.abacatepay.com'
    ]),
    'customer' => new Customer([
        'metadata' => new CustomerMetadata([
            'name' => 'John Doe',
            'cellphone' => '01912341234',
            'email' => 'john@example.com',
            'tax_id' => '13827826837'
        ])
    ])
]));
```

It is also possible to use the ID of an existing customer:

```php
// ...
    'customer' => new Customer([
        'id' => 'abc_123'
    ])
// ...
```

### Customer Management

Initialize the Customer Client

```php
use AbacatePay\Clients\CustomerClient;
use AbacatePay\Resources\Customer;

$customerClient = new CustomerClient();
```

#### List All Customers

```php
$customers = $customerClient->list();
```

#### Create a New Customer

```php
use AbacatePay\Resources\Customer;
use AbacatePay\Resources\Customer\Metadata;

$customer = $customerClient->create(new Customer([
    'metadata' => new Metadata([
        'name' => 'John Doe',
        'cellphone' => '01912341234',
        'email' => 'john@example.com',
        'tax_id' => '13827826837'
    ])
]));
```

## ⚡ Quick Tips

-   Use environment variables for API tokens
-   Enable error reporting in development
-   Always validate customer input
-   Handle exceptions appropriately
-   Keep the SDK updated

## 🔍 Error Handling

```php
use AbacatePay\Exceptions\ApiException;

try {
    $billing = $billingClient->create($billingData);
} catch (ApiException $e) {
    // Handle API-specific errors
    echo $e->getMessage();
} catch (\Exception $e) {
    // Handle general errors
    echo $e->getMessage();
}
```

## 📚 Documentation

For detailed API documentation and integration guides:

-   API Reference
-   Integration Guide
-   API Status

## 🛠️ Development

### Installing packages

```
composer install --dev
```

### Running Tests

```bash
composer test
```

## 🤝 Contributing

We welcome contributions! Please see our Contributing Guide for details.

1. Fork the repository
2. Create your feature branch (git checkout -b feature/amazing-feature)
3. Commit your changes (git commit -m 'Add amazing feature')
4. Push to the branch (git push origin feature/amazing-feature)
5. Open a Pull Request

## 🔒 Security

For security issues, please see our Security Policy.

## 📄 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 💬 Support

-   For SDK issues, open an issue
-   For API questions, contact ajuda@abacatepay.com
-   For urgent issues, contact our support team

Made with ❤️ by AbacatePay Community
