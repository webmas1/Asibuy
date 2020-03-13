<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Handle;
use Faker\Generator as Faker;

$factory->define(Handle::class, function (Faker $faker) {
    $created_at = $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now');
    return [
        'headline' => $faker->sentence(),
        'handle' => $faker->text(),
        'ticket_id' => $faker->numberBetween($min = 1, $max = 150),
        'user_id' => $faker->numberBetween($min = 1, $max = 10),
        'created_at' => $created_at,
        'updated_at' => $faker->dateTimeBetween($startDate = $created_at, $endDate = 'now')
    ];
});
