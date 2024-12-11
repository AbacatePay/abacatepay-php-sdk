# AbacatePay SDK for PHP

A robust PHP SDK for integrating AbacatePay payment solutions into your applications.

## 📋 Requirements

- PHP 7.4 or higher
- Composer
- Valid AbacatePay account and API credentials
- SSL enabled for production environments

## 💻 Installation

Install the SDK via Composer:

```bash
composer require abacatepay/php-sdk
```

## 🔧 Configuration

First, initialize the SDK with your API token:

```bash
use AbacatePay\Clients\Client;

Client::setToken($_ENV["ABACATEPAY_TOKEN"]);
```

>⚠️ Never commit your API tokens to version control. Use environment variables instead.

## 🌟 Features

- Simple billing management
- Customer management
- Multiple payment methods support
- Webhook handling
- Secure payment processing
- Error handling and logging

## 📘 Usage Examples

### Billing Management

Initialize the Billing Client

```bash
use AbacatePay\Clients\BillingClient;
use AbacatePay\Resources\Billing;
use AbacatePay\Enums\Billing\Frequencies;
use AbacatePay\Enums\Billing\Methods;

$billingClient = new BillingClient();
```

### List All Billings

```bash
$billings = $billingClient->list();
```

### Create a New Billing

```bash
$billing = $billingClient->create(new Billing([
    'frequency' => Frequencies::ONE_TIME,
    'methods' => [Methods::PIX],
    'products' => [
        new \AbacatePay\Resources\Billing\Product([
            'external_id' => 'abc_123',
            'name' => 'Product A',
            'description' => 'Description of product A',
            'quantity' => 1,
            'price' => 100 // Price in cents
        ])
    ],
    'metadata' => new \AbacatePay\Resources\Billing\Metadata([
        'return_url' => 'https://www.abacatepay.com',
        'completion_url' => 'https://www.abacatepay.com'
    ]),
    'customer' => new \AbacatePay\Resources\Customer([
        'metadata' => new \AbacatePay\Resources\Customer\Metadata([
            'name' => 'John Doe',
            'cellphone' => '01912341234',
            'email' => 'john@example.com',
            'tax_id' => '13827826837'
        ])
    ])
]));
```

## Customer Management

### Initialize the Customer Client

```bash
use AbacatePay\Clients\CustomerClient;
use AbacatePay\Resources\Customer;

$customerClient = new CustomerClient();
```

### List All Customers

```bash
$customers = $customerClient->list();
```

### Create a New Customer

```bash
$customer = $customerClient->create(new Customer([
    'metadata' => new \AbacatePay\Resources\Customer\Metadata([
        'name' => 'John Doe',
        'cellphone' => '01912341234',
        'email' => 'john@example.com',
        'tax_id' => '13827826837'
    ])
]));
```

## ⚡ Quick Tips

- Use environment variables for API tokens
- Enable error reporting in development
- Always validate customer input
- Handle exceptions appropriately
- Keep the SDK updated

## 🔍 Error Handling

```bash
try {
    $billing = $billingClient->create($billingData);
} catch (\AbacatePay\Exceptions\ApiException $e) {
    // Handle API-specific errors
    echo $e->getMessage();
} catch (\Exception $e) {
    // Handle general errors
    echo $e->getMessage();
}
```

## 📚 Documentation

For detailed API documentation and integration guides:

- API Reference
- Integration Guide
- API Status

## 🛠️ Development

### Running Tests

```bash
composer test
```

### Code Style

```bash
composer format
```

### Static Analysis

```bash
composer analyze
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

- For SDK issues, open an issue
- For API questions, contact ajuda@abacatepay.com
- For urgent issues, contact our support team

Made with ❤️ by AbacatePay Team
