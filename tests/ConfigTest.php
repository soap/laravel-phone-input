<?php

it('has default configuration values', function () {
    expect(config('phone-input.initial_country'))->toBe('th')
        ->and(config('phone-input.preferred_countries'))->toBe(['th', 'us', 'gb'])
        ->and(config('phone-input.separate_dial_code'))->toBeTrue()
        ->and(config('phone-input.national_mode'))->toBeFalse()
        ->and(config('phone-input.default_display_format'))->toBe('pretty');
});

it('has correct inline configuration', function () {
    $inlineConfig = config('phone-input.inline');
    
    expect($inlineConfig['save_on_blur'])->toBeTrue()
        ->and($inlineConfig['show_actions'])->toBeTrue()
        ->and($inlineConfig['auto_close_on_valid'])->toBeTrue();
});

it('has css classes configuration', function () {
    $classes = config('phone-input.classes');
    
    expect($classes)->toBeArray()
        ->and($classes['wrapper'])->toBe('space-y-2')
        ->and($classes['label'])->toContain('text-sm')
        ->and($classes['input'])->toContain('block w-full')
        ->and($classes['error'])->toContain('text-red-600');
});

it('has validation configuration', function () {
    $validation = config('phone-input.validation');
    
    expect($validation['show_error_on_blur'])->toBeTrue()
        ->and($validation['require_valid_number'])->toBeTrue()
        ->and($validation['auto_format'])->toBeTrue();
});

it('has localization text', function () {
    $text = config('phone-input.text');
    
    expect($text['edit_button'])->toBe('แก้ไข')
        ->and($text['save_button'])->toBe('บันทึก')
        ->and($text['cancel_button'])->toBe('ยกเลิก')
        ->and($text['placeholder'])->toBe('กรอกหมายเลขโทรศัพท์');
});

it('has cdn configuration', function () {
    expect(config('phone-input.use_cdn'))->toBeTrue();
    
    $cdnUrls = config('phone-input.cdn_urls');
    expect($cdnUrls)->toBeArray()
        ->and($cdnUrls['intl_tel_input_css'])->toContain('jsdelivr.net')
        ->and($cdnUrls['intl_tel_input_js'])->toContain('intlTelInput.min.js')
        ->and($cdnUrls['utils_js'])->toContain('utils.js');
});

it('can override config values', function () {
    // Test config merging
    config([
        'phone-input.initial_country' => 'us',
        'phone-input.preferred_countries' => ['us', 'ca', 'gb']
    ]);
    
    expect(config('phone-input.initial_country'))->toBe('us')
        ->and(config('phone-input.preferred_countries'))->toBe(['us', 'ca', 'gb']);
});