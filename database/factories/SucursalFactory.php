<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Sucursal;
use Faker\Generator as Faker;

$factory->define(Sucursal::class, function (Faker $faker) {
    return [
        'nombre' => $faker->sentence,
        'direccion' => $faker->sentence,
        'supermercado_id' =>  rand(1,3)
    ];
});
