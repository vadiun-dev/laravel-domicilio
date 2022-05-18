<?php

namespace Hitocean\LaravelDomicilio;

use Hitocean\LaravelDomicilio\Commands\LaravelDomicilioCommand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelDomicilioServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-domicilio')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_domicilio_table')
            ->hasCommand(LaravelDomicilioCommand::class);
        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Hitocean\\LaravelDomicilio\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }
}
