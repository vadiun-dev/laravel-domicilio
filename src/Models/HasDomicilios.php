<?php

namespace Hitocean\LaravelDomicilio\Models;

trait HasDomicilios
{
    public function domicilios()
    {
        return $this->morphMany(Domicilio::class, 'addressable');
    }
}
