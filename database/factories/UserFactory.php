<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $created_at = $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now');
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$0FP.p1xsnEC4b6wdAqcctuTXsL0Rg3nB/RHsHPtS1Ls29wNWzyRwi',
        'role' => 2,
        'status' => 1,
        'created_at' => $created_at,
        'updated_at' => $faker->dateTimeBetween($startDate = $created_at, $endDate = 'now')
    ];
});
