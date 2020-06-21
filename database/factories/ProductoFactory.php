<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Producto;
use Faker\Generator as Faker;

$factory->define(Producto::class, function (Faker $faker) {
    return [
        'nombre' => $faker->sentence,
        'existencias' => $faker->numberBetween(1,150),
        'precio_compra' => $faker->numberBetween(1,300),
        'precio_venta' => $faker->numberBetween(1,300),
        'categoria_id' =>  rand(1,20),
        'proveedor_id' =>  rand(1,20)
    ];
});
