# Filament Rating Tool

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lartisan/filament-rating-tool.svg?style=flat-square)](https://packagist.org/packages/lartisan/filament-rating-tool)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/lartisan/filament-rating-tool/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/lartisan/filament-rating-tool/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/lartisan/filament-rating-tool/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/lartisan/filament-rating-tool/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/lartisan/filament-rating-tool.svg?style=flat-square)](https://packagist.org/packages/lartisan/filament-rating-tool)



Filament Rating Tool is a [FilamentPHP](https://filamentphp.com) plugin meant to provide a set of tools for measuring or rating different resources of your app.

### What's different from other (star) rating tools?

Well, we thought of giving a user the possibility to choose an icon, depending on the context of the rating. 

For example, if you want to rate a movie, you can use a star icon, if you want to rate a book, you can use a book icon, if you want to provide the number of persons that can occupy a hotel room, you can use a user icon ... and so on, you get the idea. Any icon provided by Filament can be user for rating / measuring.

Also, we made it possible for a user to choose their on size for the icons, the number of icons to be displayed and also the color for the icons. Yeah, you can set different colors for the icons, depending on the rating value.

You can check some examples below or try it yourself on the [demo app](https://www.filamentcomponents.com).

## Installation

You can install the package via composer:

```bash
composer require lartisan/filament-rating-tool
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-rating-tool-views"
```

## Form Usage
When preparing a form, you need to define a `RatingInput` field and, optionally, make some configurations:

```php
RatingInput::make('rating')
    ->size('xl')
    ->maxValue(5)
    ->icon('heroicon-o-stop')
    ->color(fn (int $state): string => match ($state) {
        1 => 'danger',
        2 => 'warning',
        3 => 'info',
        4 => 'primary',
        5 => 'success',
        default => 'gray',
    }),
```

These are all the possible methods one can use to configure this field. As you can see, you can provide a `maxValue` for your input, so if you want to match some custom color based on the `$state`, you'll need the same amount of colors. Of course, one can only choose one color for all the symbols of the field

```php
RatingInput::make('rating')
    ->color('warning')
    // ...
```

## Table Usage
Similar to forms, there is a dedicated column for displaying the measurement value...

```php
RatingColumn::make('rating')
    ->size('xs')
    ->maxValue(5)
    ->icon('heroicon-s-star')
    ->color(fn (int $state): string => match ($state) {
        1 => 'danger',
        2 => 'warning',
        3 => 'info',
        4 => 'primary',
        5 => 'success',
        default => 'gray',
    }),
    // ...
```

## Infolist Usage
... and another one to display the infolist when viewing the records

```php
RatingEntry::make('rating')
    ->columnSpan(2)
    ->size('lg')
    ->maxValue(5)
    ->icon('heroicon-s-user')
    ->color(fn (int $state): string => match ($state) {
        1 => 'danger',
        2 => 'warning',
        3 => 'info',
        4 => 'primary',
        5 => 'success',
        default => 'gray',
    }),
    // ...
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Cristian Iosif](https://github.com/lartisan)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
