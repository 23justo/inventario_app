<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Categoria;
use Faker\Generator as Faker;

$factory->define(Categoria::class, function (Faker $faker) {
    return [
        'nombre' => $faker->sentence,
        'descripcion' => $faker->sentence,
        'sucursal_id' =>  rand(1,20)
    ];
});
