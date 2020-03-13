<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Ticket;
use Faker\Generator as Faker;

$factory->define(Ticket::class, function (Faker $faker) {
    $created_at = $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now');
    return [
        'subject' => $faker->sentence(),
        'ticket' => $faker->text(),
        'customer_id' => $faker->numberBetween($min = 1, $max = 50),
        'user_id' => $faker->numberBetween($min = 1, $max = 10),
        'status' => $faker->numberBetween($min = 0, $max = 1),
        'created_at' => $created_at,
        'updated_at' => $faker->dateTimeBetween($startDate = $created_at, $endDate = 'now')
    ];
});
