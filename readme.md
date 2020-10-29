# Log Outsourced - monolog extension

Monolog extension for [Outsourced Logging](https://github.com/pipan/log-outsourced-api)

## Installation

`composer require outsourced/log-monolog`

## Usage

```php
use Monolog\Logger;
use LogOutsourcedMonolog\LogOutsourcedHandler;

$logger = new Logger('name');
$logger->pushHandler(new LogOutsourcedHandler('https://uri.to/your_log/outsourced_api'));
```

### Laravel

You have to set `loggin` config to contain new monolog channel. Then you can use this channel in your application or set it as `default`.

```php
[
    'channels' => [
        'outsourced' => [
            'driver'  => 'monolog',
            'handler' => LogOutsourcedMonolog\LogOutsourcedHandler::class,
            'with' => [
                'host' => env('OUTSOURCED_HOST', 'https://outsourced.example.com'),
                'accessKey' => env('OUTSOURCED_ACCESS_KEY', 'access-key')
            ],
        ]
    ]
]
```