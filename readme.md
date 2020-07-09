# Log Outsourced - monolog extension

Monolog extension for [Log Outsourced](https://github.com/pipan/log-outsourced-api)

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
                'logOutsourcedApiUri' => env('LOG_OUTSOURCED_API_URI', 'https://uri.to/your_log/outsourced_api')
            ],
        ]
    ]
]
```