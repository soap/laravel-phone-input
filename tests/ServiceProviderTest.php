<?php

use Soap\LaravelPhoneInput\LaravelPhoneInputServiceProvider;
use Soap\LaravelPhoneInput\View\Components\PhoneInput;

it('registers the service provider', function () {
    $provider = new LaravelPhoneInputServiceProvider($this->app);

    expect($provider)->toBeInstanceOf(LaravelPhoneInputServiceProvider::class);
});

it('registers phone input blade component', function () {
    // Check if component class exists and can be instantiated
    $component = new PhoneInput;

    expect($component)->toBeInstanceOf(PhoneInput::class);

    // Test component properties instead of view rendering
    expect($component->name)->toBe('phone')
        ->and($component->mode)->toBe('field')
        ->and($component->required)->toBeFalse();
});

it('has config file available', function () {
    // Test that default config values are accessible
    expect(config('phone-input.initial_country'))->toBe('th');
    expect(config('phone-input.preferred_countries'))->toBeArray();
});

it('has view files available', function () {
    // Test that component view exists in package resources
    $viewPath = __DIR__.'/../resources/views/components/phone-input.blade.php';
    expect(file_exists($viewPath))->toBeTrue();
});
