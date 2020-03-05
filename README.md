# Rollbar for Laravel Logging

This package write rollbar by laravel logger.

#### for Laravel 5.8+


## Install

Require this package with composer using the following command:

```
composer require xzxzyzyz/laravel-logging-rollbar
```

Adding the logging driver in the `config/logging.php` file:

```php
    'channels' => [
        'stack' => [
            'driver'   => 'stack',
            'channels' => ['single', 'rollbar'],
        ],

        // ...
        
        'rollbar' => [
            'driver' => 'custom',
            'access_token' => env('LOG_ROLLBAR_TOKEN'),
            'via' => Xzxzyzyz\Laravel\Logging\Rollbar\RollbarLogger::class
        ],
    ]
```

Adding the project access token in the `.env` file:

```
LOG_ROLLBAR_TOKEN=your post_server_item token
```

Adding the dont-discover package in the `composer.json` file:

```json
{
    // ...
    
    "extra": {
        "laravel": {
            "dont-discover": [
                "rollbar/rollbar-laravels"
            ]
        }
    }
    
    // ...
}
```

And composer autoload:
```
composer dump-autoload
```

If this is not invalidated, the log may be registered in duplicate.

## LICENSE
MIT
