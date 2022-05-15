<?php

namespace Hitocean\LaravelDomicilio\Models;

trait HasDomicilio
{
    public function domicilio()
    {
        return $this->morphOne(Domicilio::class, 'addressable');
    }
}
