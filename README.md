# Syndra

[![Build Status](https://travis-ci.org/laravelista/Syndra.svg?branch=1.0.0)](https://travis-ci.org/laravelista/Syndra) [![Latest Stable Version](https://poser.pugx.org/laravelista/syndra/v/stable)](https://packagist.org/packages/laravelista/syndra) [![Total Downloads](https://poser.pugx.org/laravelista/syndra/downloads)](https://packagist.org/packages/laravelista/syndra) [![Latest Unstable Version](https://poser.pugx.org/laravelista/syndra/v/unstable)](https://packagist.org/packages/laravelista/syndra) [![License](https://poser.pugx.org/laravelista/syndra/license)](https://packagist.org/packages/laravelista/syndra)

Common JSON responses for an API built with Laravel 5.1.

## Installation

First, pull in the package through Composer.

```js
"require": {
    "laravelista/syndra": "~1.0"
}
```

And then, if using Laravel 5.1, include the service provider within `config/app.php`.

```php
'providers' => [
    ...
    Laravelista\Syndra\SyndraServiceProvider::class
];
```

And if you want you can add a facade alias to this same file at the bottom:

```php
'aliases' => [
    ...
    'Syndra' => Laravelista\Syndra\Facades\Syndra::class
];
```

## Usage

Coming soon....

## API

Coming soon...