<?php

use Illuminate\Support\Facades\File;

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
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('secret'),
        'remember_token' => str_random(10),
        'banned' => 0,
    ];
});

$factory->define(App\Visual::class, function(Faker\Generator $faker) {
    $user = factory(App\User::class)->create();
    $path = public_path() . '/' . getenv('APP_UPLOADS') . '/visuals/' . $user->id;
    File::makeDirectory($path);

    return [
        'user_id' => $user->id,
        'track' => $faker->words(2, true),
        'album' => $faker->words(2, true),
        'artist' => $faker->name,
        'image' => $faker->image($path, 1500, 500, 'abstract', false),
    ];
});
