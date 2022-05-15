<?php

namespace Hitocean\LaravelDomicilio\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Hitocean\LaravelDomicilio\LaravelDomicilio
 */
class LaravelDomicilio extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-domicilio';
    }
}
