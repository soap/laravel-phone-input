<?php

namespace Soap\LaravelPhoneInput\Commands;

use Illuminate\Console\Command;

class LaravelPhoneInputCommand extends Command
{
    public $signature = 'laravel-phone-input';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
