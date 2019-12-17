# Build Eloquent update queries from put API requests

[![Quality Score](https://scrutinizer-ci.com/g/latevaweb/laravel-query-updater/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/latevaweb/laravel-query-updater/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/latevaweb/laravel-query-updater/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/latevaweb/laravel-query-updater/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/latevaweb/laravel-query-updater/badges/build.png?b=master)](https://scrutinizer-ci.com/g/latevaweb/laravel-query-updater/build-status/master)
[![StyleCI](https://github.styleci.io/repos/227821179/shield?branch=master)](https://github.styleci.io/repos/227821179)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Laravel 6.x](https://img.shields.io/badge/Laravel-6.x-orange.svg)](http://laravel.com)

This package allows you to update fields and relations based on a request without losing data not send.

## Installation

This package can be used in Laravel 6.0 or higher.

You can install the package via composer:

`composer require latevaweb/laravel-query-updater`

The service provider will automatically get registered. Or you may manually add the service provider in your config/app.php file:

```php
'providers' => [
    // ...
    LaTevaWeb\QueryUpdater\QueryUpdaterServiceProvider::class,
];
```

## Basic usage

### Update model field based on a `put` or `patch` request: `/users` params: `['name' => 'Marc']`:

```php
use LaTevaWeb\QueryUpdater\QueryUpdater;

public function __invoke(Request $request, User $user) {
    QueryUpdater::for($user)
        ->allowedFields(['name'])
        ->save();
        
    // update
}
```

### Update model field but keep stored value if parameter is empty or null 

```php
use LaTevaWeb\QueryUpdater\QueryUpdater;

public function __invoke(Request $request, User $user) {
    QueryUpdater::for($user)
        ->allowedFields([
            KeepStored::field('name')
        ])
        ->save();
        
    // update
}
```

## Run tests

sqlite is required. Install it on ubuntu using `sudo apt-get install php7.4-sqlite3`.

execute `vendor/bin/phpunit`
