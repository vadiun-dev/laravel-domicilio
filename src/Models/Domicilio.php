<?php

namespace Hitocean\LaravelDomicilio\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domicilio extends Model
{
    use HasFactory;
    protected $table = 'domicilios';
    protected $fillable = ['calle', 'numero', 'piso', 'departamento', 'localidad', 'partido', 'provincia', 'latitud', 'longitud'];

    public function addressable()
    {
        return $this->morphTo();
    }
}
