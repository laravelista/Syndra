# Syndra

[![Latest Stable Version](https://poser.pugx.org/laravelista/syndra/v/stable)](https://packagist.org/packages/laravelista/syndra)
[![Total Downloads](https://poser.pugx.org/laravelista/syndra/downloads)](https://packagist.org/packages/laravelista/syndra)
[![License](https://poser.pugx.org/laravelista/syndra/license)](https://packagist.org/packages/laravelista/syndra)
[![Build Status](https://travis-ci.org/laravelista/Syndra.svg?branch=1.0.0)](https://travis-ci.org/laravelista/Syndra)

[![forthebadge](http://forthebadge.com/images/badges/built-by-developers.svg)](http://forthebadge.com)
[![forthebadge](http://forthebadge.com/images/badges/powered-by-electricity.svg)](http://forthebadge.com)

Syndra is a Laravel package. It provides you with predefined JSON responses to use in your API.

## Overview

When building an API you have to standardize it so that you can always expect the same response for similar requests.

When using resource controllers these methods usually are: `index`, `store`, `update`, `destroy`.

### Index

For the `index` method you want to output data. That can be achieved with `Syndra::respond($data)`. By default the status code is *200*, but you can change it manually using `Syndra::setStatusCode($statusCode)->respond($data)`. Syndra goes great with [Fractal](http://fractal.thephpleague.com/). To learn how to use them together read [Laravel API 101](https://laravelista.com/series/laravel-api-101).

Another thing that you will most likely want to do is to enable CORS. This can be achieved by setting the appropriate headers:

```
return Syndra::setHeaders([
        'Access-Control-Allow-Origin' => '*',
    ])
    ->setStatusCode($statusCode)
    ->respond($data);
```

### Store

In the `store` method you want to return that the resource was created. Syndra enables you to do this easily with `Syndra::respondCreated()`. This generates the following response:

```json
{
    "message": "Created",
    "status_code": 201
}
```

You can customize the message by passing the message as a parameter `Syndra::respondCreated('The resource has been created!')`.

### Update

You can almost guess which method we use for when the resource has been updated by now; `Syndra::respondUpdated()`. By default this returns message `Updated` with status code *202*. As with `respondCreated`, you can set the message by passing it as a parameter to `respondUpdated`.

### Destroy

For the `destroy` method I like to return status code *200* with a message `Ok`. This can be done with `Syndra::respondOk()`.

By applying what you have learned so far, you can now easily build your API responses however you want and they will be consistent throughout your entire API.

## Advanced Usage

In this chapter I will show you how to handle most common situations which can occur in your application.

### Handling Validation Errors

If you are using `$this->validate($request, $rules)` from your controller to validate data, you would want Syndra to return validation errors if the validation fails. To do that, go to `app/Exceptions/Handler.php` and in `render` method add this block of code:

```php
if ($e instanceof ValidationException) {
    return \Syndra::respondValidationError(
        $e->validator->errors()->getMessages()
    );
}
```

If the validation fails, the response will be similar to the one bellow but with different messages:

```json
{
    "error" : {
        "message": {
            "email": [
				"The email format is invalid."
			]
		},
		"status_code": 422
    }
}
```

### Handling Model Not Found Errors

Similar to handling validation errors, model not found errors are addressed in the same way. Go to `app/Exceptions/Handler.php` and in `render` method add this block of code:

```php
if ($e instanceof ModelNotFoundException) {
    return \Syndra::respondNotFound();
}
```

Now every time you use `Model::findOrFail($id)` in your controller and it does not find anything you will get this JSON response:

```json
{
    "error" : {
        "message": "Not Found",
		"status_code": 404
    }
}
```

### Handling Authentication & Authorization Errors

From your `AuthController`, if the authentication attempt fails you can return `Syndra::respondUnauthorized()` or if the authenticated user lacks permissions to do something you can return `Syndra::respondForbidden()`. Both methods accept message as the first parameter.

> **Hint!** You can even pass an array instead of a string as a message.

### Handling Server Errors

In the case that something goes terribly wrong, you can shamefully respond with `Syndra::respondInternalError()`.

## Installation

From the command line:

```bash
composer require laravelista/syndra
```

Include the service provider in `config/app.php`:

```php
'providers' => [
    ...,
    Laravelista\Syndra\SyndraServiceProvider::class
];
```

And add a facade alias to the same file at the bottom:

```php
'aliases' => [
    ...,
    'Syndra' => Laravelista\Syndra\Facades\Syndra::class
];
```

## API

There are two way of working with Syndra. As a facade `Syndra::respond($data)` or as a injected dependency `$this->syndra->respond($data)`:

```
use Laravelista\Syndra\Syndra;

protected $syndra;

public function __construct(Syndra $syndra)
{
    $this->syndra = $syndra
}
```

### Common responses

#### respond

This is useful for `index` and `show` method. Use this when you want to return custom JSON output, like the one you get from [Fractal](http://fractal.thephpleague.com/).

```php
Syndra::respond(array $data)
```

#### respondWithMessage

Use this for responding with messages. This returns a predefined *message* JSON template which contains the message and the status code.

```php
Syndra::respondWithMessage($message='Ok')
```

**Response:**

```json
{
    "message": "Ok",
    "status_code": 200
}
```

#### respondWithError

Use this for responding with error messages. This returns a predefined *error* JSON template which contains the message and the status code wrapped in *error*.

```php
Syndra::respondWithError($message='Error')
```

**Response:**

```json
{
    "error": {
        "message": "Error",
        "status_code": 200
    }
}
```

### HTTP Status Codes 2xx

#### respondOk

Use this to respond with a message **(200)**.

```php
Syndra::respondOk($message='Ok')
```

#### respondCreated

Use this when a resource has been created **(201)**.

```php
Syndra::respondCreated($message='Created')
```

#### respondUpdated

Use this when a resource has been updated **(202)**.

```php
Syndra::respondUpdated($message='Updated')
```

### HTTP Status Codes 4xx

#### respondUnauthorized

Use this when the user needs to be authorized to do something **(401)**.

```php
Syndra::respondUnauthorized($message='Unauthorized')
```

#### respondForbidden

Use this when the user does not have permission to do something **(403)**.

```php
Syndra::respondForbidden($message='Forbidden')
```

#### respondNotFound

Use this when a resource is not found **(404)**.

```php
Syndra::respondNotFound($message='Not Found')
```

#### respondValidationError

Use this when the validation fails **(422)**.

```php
Syndra::respondValidationError($message='Validation Error')
```

### HTTP Status Codes 5xx

#### respondInternalError

Use this for general server errors **(500)**.

```php
Syndra::respondInternalError($message='Internal Error')
```

#### respondNotImplemented

Use this for HTTP not implemented errors **(501)**.

```php
Syndra::respondNotImplemented($message='Not Implemented')
```

### Manipulating the status code

#### setStatusCode

Sets status code manually. This method can be chained (combined) with other methods.

```php
Syndra::setStatusCode($statusCode)
```

**Example:**

```
Syndra::setStatusCode(200)->respond($data);
```

### Manipulating headers

#### setHeaders

Sets headers on the response. This method can be chained (combined) with other methods.

```php
Syndra::setHeaders(array $headers)
```

**Example:**

```
Syndra::setHeaders($headers)->respondWithMessage('Hello World!');
```

## Credits

Many thanks to:

- [@delatbabel](https://github.com/delatbabel) for `notImplemented` method and default message values
