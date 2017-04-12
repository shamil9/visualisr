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
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'avatar' => $faker->imageUrl(128, 128, 'people'),
        'banned' => 0,
    ];
});

$factory->define(App\Visual::class, function(Faker\Generator $faker) {
    return [
        'user_id' => factory(App\User::class)->create()->id,
        'track' => $faker->words(2, true),
        'album' => $faker->words(2, true),
        'artist' => $faker->name,
        'image' => $faker->imageUrl(1500, 500, 'abstract'),
    ];
});
