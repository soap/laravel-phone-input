<?php

use Soap\LaravelPhoneInput\View\Components\PhoneInput;

it('can instantiate phone input component', function () {
    $component = new PhoneInput;

    expect($component)->toBeInstanceOf(PhoneInput::class)
        ->and($component->name)->toBe('phone')
        ->and($component->mode)->toBe('field')
        ->and($component->required)->toBeFalse()
        ->and($component->placeholder)->toBe('Enter phone number');
});

it('can set custom component properties', function () {
    $component = new PhoneInput(
        name: 'mobile',
        label: 'Mobile Number',
        value: '+66812345678',
        required: true,
        mode: 'inline'
    );

    expect($component->name)->toBe('mobile')
        ->and($component->label)->toBe('Mobile Number')
        ->and($component->value)->toBe('+66812345678')
        ->and($component->required)->toBeTrue()
        ->and($component->mode)->toBe('inline');
});

it('can render field mode component', function () {
    $component = new PhoneInput(
        name: 'phone',
        label: 'Phone Number',
        placeholder: 'กรอกหมายเลขโทรศัพท์'
    );

    // Test component properties
    expect($component->name)->toBe('phone')
        ->and($component->label)->toBe('Phone Number')
        ->and($component->placeholder)->toBe('กรอกหมายเลขโทรศัพท์')
        ->and($component->mode)->toBe('field');
});

it('can render inline mode component', function () {
    $component = new PhoneInput(
        mode: 'inline',
        value: '+66812345678',
        displayFormat: 'pretty'
    );

    expect($component->mode)->toBe('inline')
        ->and($component->displayFormat)->toBe('pretty')
        ->and($component->inlineSaveOnBlur)->toBeTrue()
        ->and($component->inlineShowActions)->toBeTrue();
});
