<?php

namespace Soap\LaravelPhoneInput;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Soap\LaravelPhoneInput\Commands\LaravelPhoneInputCommand;

class LaravelPhoneInputServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-phone-input')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel_phone_input_table')
            ->hasCommand(LaravelPhoneInputCommand::class);
    }
}
