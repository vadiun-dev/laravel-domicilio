<?php

namespace Hitocean\LaravelDomicilio\Database\Factories;

use Hitocean\LaravelDomicilio\Models\Domicilio;
use Illuminate\Database\Eloquent\Factories\Factory;

class DomicilioFactory extends Factory
{
    protected $model = Domicilio::class;

    public function definition()
    {
        return [
            'calle'           => $this->faker->name,
            'numero'    => $this->faker->randomNumber(3),
            'provincia'         => $this->faker->name,
            'latitud'         => $this->faker->randomFloat(),
            'longitud'        => $this->faker->randomFloat(),
            'addressable_id'   => $this->faker->randomNumber(3),
            'addressable_type' => $this->faker->name,
        ];
    }
}
