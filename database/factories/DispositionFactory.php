<?php

use Faker\Generator as Faker;

$factory->define(App\Disposition::class, function (Faker $faker) {
    return [
        'code' => $faker->name,
        'description' => $faker->name,
    ];
});
