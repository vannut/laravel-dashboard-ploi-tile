# Ploi.io Tile

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vannut/laravel-dashboard-ploi-tile.svg?style=flat-square)](https://packagist.org/packages/vannut/laravel-dashboard-ploi-tile)
[![Total Downloads](https://img.shields.io/packagist/dt/vannut/laravel-dashboard-ploi-tile.svg?style=flat-square)](https://packagist.org/packages/vannut/laravel-dashboard-ploi-tile)

This package gives you tiles to display the status of your infrastructure managed with [Ploi.io](https://ploi.io/register?referrer=VIkpcjy7dXLg5wqyYILz). It can add deployment status from one or multiple sites and the state of your server resources. For the latter you need a subscription which includes server-monitoring.

This tile can be used on [the Laravel Dashboard](https://docs.spatie.be/laravel-dashboard).

## Installation

You can install the package via composer:

```bash
composer require vannut/laravel-dashboard-ploi-tile
```

## Usage
First obtain a personal access-token with the following permissions: `read_servers` & `read_sites`

Change your `/config/dashboard.php` to have a ploi entry in the `dashboard.tiles` array:
```php
// ...
'tiles' => [
     // ...
    'ploi' => [
        // Your api token
        'api_token' => 'eyJ0eXAi.....',
        // the server which you want to show
        'servers' => [1234],
        // Sites for which you want to track deployments
        // serverId:siteId
        'sites' => [
            '1234:5678'
        ],
        // optional
        // 'alert_tresholds' => [
        //     'cpu' => 75,
        //     'ram' => 75,
        //     'disk' => 80
        // ],
        // 'deployment_refresh_interval_in_seconds' => 10
        // 'resources_refresh_interval_in_seconds' => 60
    ],
]
```

In `app\Console\Kernel.php` you need to schedule the commands below to run every x minutes. Off course only add the command(s) you need for your dashboard.
```php
protected function schedule(Schedule $schedule)
{
    $schedule->command(Vannut\PloiTile\FetchDeploymentDataFromApiCommand::class)->everyMinute();
    // $schedule->command(Vannut\PloiTile\FetchResourcesDataFromApiCommand::class)->everyMinute(); not yet implemented
}
```

## Components
In your dashboard you will have the following tiles at your disposal

```html
<x-dashboard>
    <livewire:ploi-resources-tile position="a1:a6" />
    <livewire:ploi-deployments-tile position="b1:b6" />
    <livewire:ploi-single-deployment-tile
        position="c1"
        id="1234:5678"
        />
</x-dashboard>
```

## Testing

``` bash
composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email security@vannut.nl instead of using the issue tracker.

## Credits

- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
