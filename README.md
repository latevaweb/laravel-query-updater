# Build Eloquent update queries from put API requests

This package allows you to update fields and relations based on a request without losing data not send.

## Basic usage

### Update model field based on a `put` request: `/users` params: `['name' => 'Marc']`:

```php
use Mguinea\QueryUpdater\QueryUpdater;

public function __invoke(Request $request, User $user) {
    $user = QueryUpdater::for($user)
        ->allowedFields(['name'])
        ->save();
        
    // update
}
```

## Run tests

sqlite is required. Install it on ubuntu using `sudo apt-get install php-sqlite3`