<?php

namespace Hitocean\LaravelDomicilio\Commands;

use Illuminate\Console\Command;

class LaravelDomicilioCommand extends Command
{
    public $signature = 'laravel-domicilio';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
