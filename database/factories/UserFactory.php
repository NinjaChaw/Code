<?php

use Faker\Generator as Faker;
use App\Models\User;

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

    return [
        'name' => $faker->unique()->name,
        'email' => $faker->unique()->safeEmail,
        'role' => User::ROLE_USER,
        'status' => User::STATUS_ACTIVE,
        'last_login_time' => $faker->dateTimeBetween('-1 years', '-0 seconds'),
        'last_login_ip' => $faker->ipv4,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
