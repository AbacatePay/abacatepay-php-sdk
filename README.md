# AbacatePay SDK for PHP

## 💻 Installation

```
composer require abacatepay/php-sdk
```

## 🌟 Resources

### Billing

#### Start client

```php
$billingClient = new \AbacatePay\Client\BillingClient();
```

#### List billings

```php
$billingClient->list();
```

#### Create a billing

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
            'price' => 100
        ])
    ],
    'metadata' => new \AbacatePay\Resources\Billing\Metadata([
        'return_url' => 'https://www.abacatepay.com',
        'completion_url' => 'https://www.abacatepay.com'
    ])
]));
```

## 📚 Documentation

[https://abacatepay.readme.io/reference](https://abacatepay.readme.io/reference)
