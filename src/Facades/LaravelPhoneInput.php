<?php

namespace Soap\LaravelPhoneInput\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Soap\LaravelPhoneInput\LaravelPhoneInput
 */
class LaravelPhoneInput extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Soap\LaravelPhoneInput\LaravelPhoneInput::class;
    }
}
