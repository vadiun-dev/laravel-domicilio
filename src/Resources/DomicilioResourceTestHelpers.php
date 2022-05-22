<?php

namespace Hitocean\LaravelDomicilio\Resources;

use Hitocean\LaravelDomicilio\Models\Domicilio;

class DomicilioResourceTestHelpers extends ResourceTestHelper
{
    /**
     * @param Domicilio $domicilio
     * @return array
     */
    protected static function mapModel($domicilio): array
    {
        return [
           'calle' => $domicilio->calle,
           'numero' => $domicilio->numero,
           'piso' => $domicilio->piso,
           'departamento' => $domicilio->departamento,
           'localidad' => $domicilio->localidad,
           'partido' => $domicilio->partido,
           'provincia' => $domicilio->provincia,
           'latitud' => $domicilio->latitud,
           'longitud' => $domicilio->longitud,
       ];
    }
}
