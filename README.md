# AbacatePay SDK for PHP

## 💻 Installation

To install the SDK, use Composer:

```
composer require abacatepay/php-sdk
```

## 🔧 Configuration

Set your API token before making requests:

```php
\AbacatePay\Clients\Client::setToken($_ENV["ABACATEPAY_TOKEN"]);
```

## 🌟 Resources

### Billing

#### Initialize the Billing Client

```php
$billingClient = new \AbacatePay\Clients\BillingClient();
```

#### List billings

Retrieve a list of all billings:

```php
$billingClient->list();
```

#### Create a billing

To create a billing, use the following code:

```php
$billingClient->create(new \AbacatePay\Resources\Billing([
    'frequency' => \AbacatePay\Enums\Billing\Frequencies::ONE_TIME,
    'methods' => [ \AbacatePay\Enums\Billing\Methods::PIX ],
    'products' => [
        new \AbacatePay\Resources\Billing\Product([
            'external_id' => 'abc_123',
            'name' => 'Produto A',
            'description' => 'Descrição do produto A',
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
            'name' => 'Abacate Lover',
            'cellphone' => '01912341234',
            'email' => 'lover@abacate.com',
            'tax_id' => '13827826837'
        ])
    ])
]));
```

Alternatively, you can use a previously created customer by specifying their ID:

```php
'customer' => new \AbacatePay\Resources\Customer([
    'id' => 'cust_DEbpqcN...',
])
```

### Customer

#### Initialize the Customer Client

```php
$customerClient = new \AbacatePay\Clients\CustomerClient();
```

#### List customers

Retrieve a list of all customers:

```php
$customerClient->list();
```

#### Create a billing

To create a customer, use the following code:

```php
$customerClient->create(new \AbacatePay\Resources\Customer([
    'metadata' => new \AbacatePay\Resources\Customer\Metadata([
        'name' => 'Abacate Lover',
        'cellphone' => '01912341234',
        'email' => 'lover@abacate.com',
        'tax_id' => '13827826837'
    ])
]));
```

## 📚 Documentation

For detailed information about the API and SDK, refer to the official documentation:
[https://abacatepay.readme.io/reference](https://abacatepay.readme.io/reference)

## 🤝 Contribution

Contributions are welcome! If you wish to contribute:

1. Fork the repository.

2. Create a new branch for your feature or fix:

```bash
git checkout -b feature/your-feature-name
```

3. Make your changes and commit them:

```bash
git commit -m "Add your detailed commit message here"
```

4. Push to your branch:

```bash
git push origin feature/your-feature-name
```

5. Open a pull request with a clear description of your changes.

Please ensure your code adheres to the project's coding standards and includes appropriate tests.

### Happy coding! 🚀
