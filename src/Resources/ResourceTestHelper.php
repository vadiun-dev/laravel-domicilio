<?php


namespace Hitocean\LaravelDomicilio\Resources;


use Illuminate\Support\Collection;

abstract class ResourceTestHelper {

    public static function complete($models)
    {
        if(is_a($models,Collection::class))
        {
            $_models = [];
            foreach($models as $biller)
                $_models[] = static::mapModel($biller);
            return $_models;
        }

        if(is_array($models))
            return array_map(fn($biller) => static::mapModel($biller), $models);
        else
            return static::mapModel($models);
    }

    protected abstract static function mapModel($model): array;

    public static function paginate(string $route, $data = [], int $per_page = 10)
    {
        return [
            'data'  => $data,
            'links' => [
                'first' => "http://localhost/" . $route . '?page=1',
                'last'  => "http://localhost/" . $route . '?page=1',
                'next'  => null,
                'prev'  => null
            ],
            'meta'  => [
                'current_page' => 1,
                'from'         => 1,
                'last_page'    => 1,
                'links'        => [
                    ["active" => false, "label" => "&laquo; Anterior", "url" => null],
                    ["active" => true, "label" => "1", "url" => "http://localhost/$route?page=1"],
                    ["active" => false, "label" => "Siguiente &raquo;", "url" => null]
                ],
                'path'         => "http://localhost/$route",
                'per_page'     => $per_page,
                'to'           => count($data) > $per_page ? $per_page : count($data),
                'total'        => count($data)
            ],

        ];
    }
}
