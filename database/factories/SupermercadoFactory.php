<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Supermercado;
use Faker\Generator as Faker;

$factory->define(Supermercado::class, function (Faker $faker) {
    return [
        'nombre' => $faker->sentence,
    ];
});
