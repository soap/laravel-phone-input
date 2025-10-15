<?php

use Soap\LaravelPhoneInput\Commands\LaravelPhoneInputInstallCommand;

it('can run install command', function () {
    $this->artisan('laravel-phone-input:install')
        ->expectsOutput('All done')
        ->assertExitCode(0);
});

it('install command is registered', function () {
    // Test that command can be instantiated
    $command = new LaravelPhoneInputInstallCommand();
    
    expect($command)->toBeInstanceOf(LaravelPhoneInputInstallCommand::class);
});

it('install command has correct signature', function () {
    $command = new LaravelPhoneInputInstallCommand();
    
    expect($command->signature)->toBe('laravel-phone-input:install')
        ->and($command->description)->toBe('Install the Laravel Phone Input package');
});