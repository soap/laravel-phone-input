<?php

// config for Soap/LaravelPhoneInput
return [

    /*
    |--------------------------------------------------------------------------
    | International Telephone Input (intl-tel-input) Settings
    |--------------------------------------------------------------------------
    |
    | Configuration for the intl-tel-input library that powers the phone input
    | component. These settings control country selection, formatting, and
    | display behavior.
    |
    */

    'initial_country' => 'th', // ISO 3166-1 alpha-2 country code

    'preferred_countries' => ['th', 'us', 'gb'], // Countries to show at top of dropdown

    'separate_dial_code' => true, // Show country dial code separately from input

    'national_mode' => false, // When true, format numbers in national format instead of international

    /*
    |--------------------------------------------------------------------------
    | Display Format Options
    |--------------------------------------------------------------------------
    |
    | Default display format for inline mode when showing the phone number.
    | Options: 'pretty' (international), 'national', 'e164'
    |
    */

    'default_display_format' => 'pretty',

    /*
    |--------------------------------------------------------------------------
    | Inline Mode Settings
    |--------------------------------------------------------------------------
    |
    | Configuration for inline editing behavior when using the component
    | in inline mode.
    |
    */

    'inline' => [
        'save_on_blur' => true, // Auto-save when input loses focus
        'show_actions' => true, // Show edit/save/cancel buttons
        'auto_close_on_valid' => true, // Close editing mode when number is valid
    ],

    /*
    |--------------------------------------------------------------------------
    | CSS Classes
    |--------------------------------------------------------------------------
    |
    | Customize the appearance of the phone input component by specifying
    | CSS classes for different elements. These can be overridden per
    | component instance using props.
    |
    */

    'classes' => [
        'wrapper' => 'space-y-2',
        'label' => 'block text-sm font-medium text-gray-700',
        'input' => 'block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm',
        'help' => 'text-sm text-gray-500',
        'error' => 'text-sm text-red-600',
        'inline_display' => 'min-h-[2.25rem] py-1 text-sm',
        'inline_actions' => 'flex items-center gap-2',
        'inline_button' => 'text-sm px-2 py-1 rounded border hover:bg-gray-50',
    ],

    /*
    |--------------------------------------------------------------------------
    | Validation Settings
    |--------------------------------------------------------------------------
    |
    | Configuration for phone number validation behavior.
    |
    */

    'validation' => [
        'show_error_on_blur' => true, // Show validation errors when input loses focus
        'require_valid_number' => true, // Only accept valid phone numbers
        'auto_format' => true, // Automatically format numbers as user types
    ],

    /*
    |--------------------------------------------------------------------------
    | Localization
    |--------------------------------------------------------------------------
    |
    | Text strings used in the component interface. These can be translated
    | by publishing the language files.
    |
    */

    'text' => [
        'edit_button' => 'แก้ไข',
        'save_button' => 'บันทึก',
        'cancel_button' => 'ยกเลิก',
        'placeholder' => 'กรอกหมายเลขโทรศัพท์',
        'invalid_number' => 'หมายเลขโทรศัพท์ไม่ถูกต้อง',
        'required_field' => 'จำเป็นต้องกรอก',
    ],

    /*
    |--------------------------------------------------------------------------
    | CDN Settings
    |--------------------------------------------------------------------------
    |
    | Configuration for loading external dependencies from CDN.
    | Set to false to use local assets instead.
    |
    */

    'use_cdn' => true,

    'cdn_urls' => [
        'intl_tel_input_css' => 'https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css',
        'intl_tel_input_js' => 'https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js',
        'utils_js' => 'https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js',
    ],

];
