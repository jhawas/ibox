<?php

use Faker\Generator as Faker;

$factory->define(App\Patient::class, function (Faker $faker) {
	$civil_status = array(
		'single',
		'married',
		'widowed'
	);
	$key = array_rand($civil_status);
    return [
        'first_name' => $faker->firstName,
        'middle_name' => $faker->lastName,
        'last_name' => $faker->lastName,
        'suffix' => $faker->suffix,
        'birthdate' => $faker->date,
        'religion' => 'catholic',
        'sex' => rand(0, 1) ? 'male' : 'female',
        'civil_status' => $civil_status[$key],
        'address' => $faker->address,
        'spouse' => $faker->name('female'),
        'spouse_address' => $faker->address,
        'mother' => $faker->name('female'),
        'father' =>  $faker->name('male'),
        'e_name' => $faker->name,
        'e_contact' => $faker->phoneNumber,
        'e_address' => $faker->address,
    ];
});
