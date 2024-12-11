# Security Policy

## 🔒 Reporting a Vulnerability

At AbacatePay, we take security seriously. If you discover a security vulnerability within our PHP SDK, please follow these steps:

1. **DO NOT** open a public GitHub issue
2. Email us at [ajuda@abacatepay.com](mailto:ajuda@abacatepay.com)
3. Include detailed information about the vulnerability
4. Allow us up to 48 hours for an initial response
5. Please avoid sharing the vulnerability details publicly until we've had a chance to address it

## 🛡️ Security Best Practices

When using the AbacatePay PHP SDK, please follow these security guidelines:

### API Token Security
- Never commit your API tokens to version control
- Use environment variables or secure secret management systems
- Rotate your API tokens periodically
- Use different tokens for development and production environments

```php
// Good Practice
\AbacatePay\Clients\Client::setToken($_ENV["ABACATEPAY_TOKEN"]);

// Bad Practice - Never do this
\AbacatePay\Clients\Client::setToken("abc123xyz...");
