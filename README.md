# Verimor notifications channel for Laravel 5.3+

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/umuttaymaz/laravel-notification-verimor/master.svg?style=flat-square)](https://travis-ci.org/umuttaymaz/laravel-notification-verimor)
[![StyleCI](https://styleci.io/repos/123153620/shield)](https://styleci.io/repos/123153620)
[![Total Downloads](https://img.shields.io/packagist/dt/umuttaymaz/laravel-notification-verimor.svg?style=flat-square)](https://packagist.org/packages/umuttaymaz/laravel-notification-verimor)

This package makes it easy to send notifications using [VerimorSMS](https://verimor.com.tr) with Laravel 5.3+.

## Contents

- [Installation](#installation)
	- [Setting up the VerimorSMS service](#setting-up-the-VerimorSMS-service)
- [Usage](#usage)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation

You can install the package via composer:

```bash
composer require umuttaymaz/laravel-notification-verimor
```

Then you must install the service provider:
```php
// config/app.php
'providers' => [
    ...
    UmutTaymaz\VerimorSMS\VerimorSMSServiceProvider::class,
],
```
### Setting up the VerimorSMS service

Add your Verimor username, password and default sender name to your `.env`:

```
VERIMOR_USERNAME=username
VERIMOR_PASSWORD=apiPassword
VERIMOR_HEADER=verifiedHeader
```
## Usage

You can use the channel in your `via()` method inside the notification:

```php
use Illuminate\Notifications\Notification;
use NotificationChannels\SmscRu\SmscRuMessage;
use NotificationChannels\SmscRu\SmscRuChannel;

class AccountApproved extends Notification
{
    public function via($notifiable)
    {
        return [VerimorSMSChannel::class];
    }

    public function toVerimor($notifiable)
    {
        return VerimorSMSMessage::create('This is notification message');
    }
}
```

In your notifiable model, make sure to include a routeNotificationForVerimor() method, which return the phone number.

```php
public function routeNotificationForVerimor()
{
    return $this->phone;
}
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email umut@kreator.com.tr instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Umut Taymaz](https://github.com/umuttaymaz)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
