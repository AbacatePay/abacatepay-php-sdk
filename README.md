# AbacatePay SDK for PHP

## 💻 Installation

```
composer require abacatepay/php-sdk
```

## 🔧 Configuration

```php
\AbacatePay\Clients\Client::setToken($_ENV["ABACATEPAY_TOKEN"]);
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

It is possible to use a previously created customer by only informing the id:

```php
'customer' => new \AbacatePay\Resources\Customer([
    'id' => 'cust_DEbpqcN...',
])
```

### Customer

#### Start client

```php
$customerClient = new \AbacatePay\Client\CustomerClient();
```

#### List customers

```php
$customerClient->list();
```

#### Create a billing

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

[https://abacatepay.readme.io/reference](https://abacatepay.readme.io/reference)
