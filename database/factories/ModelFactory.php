<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'role_id' => $faker->randomElement([null, 1]),
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'active' => $faker->randomElement(['0', '1']),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Attraction::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 10),
        'name' => $faker->sentence(7, 11),
        'body' => $faker->paragraphs(rand(10, 15), true),
    ];
});

$factory->define(App\Photo::class, function (Faker\Generator $faker) {
    return [
        'path' => $faker->randomElement(['photos/1.jpg', 'photos/2.jpg', 'photos/3.jpg', 'photos/4.jpg', 'photos/5.jpg', 'photos/6.jpg']),
    ];
});

$factory->define(App\Review::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 10),
        'attraction_id' => $faker->numberBetween(1, 10),
        'rating' => $faker->randomElement(['1', '2', '3', '4', '5']),
        'content' => $faker->paragraphs(rand(10, 15), true),
        'visible' => $faker->randomElement(['0', '1']),
    ];
});