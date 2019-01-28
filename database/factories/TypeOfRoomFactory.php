<?php

use Faker\Generator as Faker;

$factory->define(App\TypeOfRoom::class, function (Faker $faker) {
    return [
        'code' => $faker->word,
        'description' => $faker->sentence,
    ];
});
