<?php

use Faker\Generator as Faker;

$factory->define(App\UserRole::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'role_id' => 4
    ];
});
