<?php

use Faker\Generator as Faker;

$factory->define(App\Result::class, function (Faker $faker) {
    return [
        'code' => $faker->name,
        'description' => $faker->name,
    ];
});
