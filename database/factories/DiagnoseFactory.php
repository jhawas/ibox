<?php

use Faker\Generator as Faker;

$factory->define(App\Diagnose::class, function (Faker $faker) {
    return [
        'code' => $faker->word,
        'description' => $faker->sentence,
    ];
});
