<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    $created_at = $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now');
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'id_number' => $faker->unique()->numberBetween($min = 100000000, $max = 999999999),
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->unique()->regexify('05\d\d{7}'),
        'created_at' => $created_at,
        'updated_at' => $faker->dateTimeBetween($startDate = $created_at, $endDate = 'now')
    ];
});
