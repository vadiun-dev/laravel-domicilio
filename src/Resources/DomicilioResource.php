<?php

namespace Hitocean\LaravelDomicilio\Resources;

use Hitocean\LaravelDomicilio\Models\Domicilio;
use Illuminate\Http\Resources\Json\JsonResource;

class DomicilioResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var Domicilio $this */
        return [
            'calle' => $this->calle,
            'numero' => $this->numero,
            'piso' => $this->piso,
            'departamento' => $this->departamento,
            'localidad' => $this->localidad,
            'partido' => $this->partido,
            'provincia' => $this->provincia,
            'latitud' => $this->latitud,
            'longitud' => $this->longitud,
        ];
    }
}
