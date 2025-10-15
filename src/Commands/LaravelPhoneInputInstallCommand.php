<?php

namespace Soap\LaravelPhoneInput\Commands;

use Illuminate\Console\Command;

class LaravelPhoneInputInstallCommand extends Command
{
    public $signature = 'laravel-phone-input:install';

    public $description = 'Install the Laravel Phone Input package';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
