<?php

namespace Lartisan\RatingTool;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class RatingToolServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-rating-tool';

    public static string $viewNamespace = 'filament-rating-tool';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasViews();
    }
}
