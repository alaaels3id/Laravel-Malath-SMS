# This package is to integrate with Malath SMS

## Installation

You can install the package via [Composer](https://getcomposer.org).

```bash
composer require alaaels3id/laravel-malath-sms
```
## Publishing

After install publish file config

```bash
php artisan vendor:publish --tag="malath"
```

## Usage

```php
use Alaaelsaid\LaravelMalathSms\Facade\Malath;

Malath::send('9665xxxxxxxx', 'hello, world !');
