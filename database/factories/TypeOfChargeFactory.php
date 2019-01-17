<?php

use Faker\Generator as Faker;

$factory->define(App\TypeOfCharge::class, function (Faker $faker) {
    return [
        'code' => $faker->word,
        'description' => $faker->sentence,
        'price' => $faker->randomFloat,
        'type_id' => $faker->numberBetween(1, 4),
    ];
});
	