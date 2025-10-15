<?php

namespace Soap\LaravelPhoneInput;

<<<<<<< HEAD
use Soap\LaravelPhoneInput\Commands\LaravelPhoneInputCommand;
=======
use Soap\LaravelPhoneInput\Commands\LaravelPhoneInputInstallCommand;
use Soap\LaravelPhoneInput\View\Components\PhoneInput;
>>>>>>> a068fe1 (feat: first commit)
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            ->hasViewComponent('phone-input', PhoneInput::class)
            ->hasCommand(LaravelPhoneInputInstallCommand::class);
    }
}
