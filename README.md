# This package is to integrate with Malath SMS

## Installation

You can install the package via [Composer](https://getcomposer.org).

```bash
composer require alaaelsaid/laravel-malath-sms
```
## Publishing

After install publish file config

```bash
php artisan vendor:publish --provider="Alaaelsaid\LaravelMalathSms\Providers\MalathServiceProvider"
```

## Usage

```php
use Alaaelsaid\LaravelMalathSms\Facade\Malath;

Malath::send('9665xxxxxxxx', 'hello, world !');
