# Build Eloquent update queries from put API requests

[![Code Quality](https://scrutinizer-ci.com/g/latevaweb/laravel-query-updater/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/latevaweb/laravel-query-updater/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/latevaweb/laravel-query-updater/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/latevaweb/laravel-query-updater/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/latevaweb/laravel-query-updater/badges/build.png?b=master)](https://scrutinizer-ci.com/g/latevaweb/laravel-query-updater/build-status/master)
[![StyleCI](https://github.styleci.io/repos/227821179/shield?branch=master)](https://github.styleci.io/repos/227821179)

This package allows you to update fields and relations based on a request without losing data not send.

## Basic usage

### Update model field based on a `put` or `patch` request: `/users` params: `['name' => 'Marc']`:

```php
use LaTevaWeb\QueryUpdater\QueryUpdater;

public function __invoke(Request $request, User $user) {
    $user = QueryUpdater::for($user)
        ->allowedFields(['name'])
        ->save();
        
    // update
}
```

### Update model field but keep default value if parameter is empty or null 

```php
use LaTevaWeb\QueryUpdater\QueryUpdater;

public function __invoke(Request $request, User $user) {
    $user = QueryUpdater::for($user)
        ->allowedFields([
            KeepDefault::keep('name')
        ])
        ->save();
        
    // update
}
```

## Run tests

sqlite is required. Install it on ubuntu using `sudo apt-get install php-sqlite3`