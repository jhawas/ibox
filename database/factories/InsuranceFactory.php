<?php

use Faker\Generator as Faker;

$factory->define(App\Insurance::class, function (Faker $faker) {
    return [
        'code' => $faker->word,
        'description' => $faker->sentence
    ];
});
