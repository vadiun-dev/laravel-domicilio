<?php

namespace Hitocean\LaravelDomicilio\DTOS;

class DomicilioDTO
{
    public string $calle;
    public int $numero;
    public ?int $piso;
    public ?string $departamento;
    public ?string $localidad;
    public ?string $partido;
    public string $provincia;
    public string $pais;
    public float $latitud;
    public float $longitud;
}
