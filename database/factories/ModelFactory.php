<?php

use App\User;
use App\Visual;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

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
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => bcrypt('secret'),
        'remember_token' => str_random(10),
        'banned'         => 0,
    ];
});

$factory->define(App\Visual::class, function (Faker\Generator $faker) {
    $user = factory(App\User::class)->create(['created_at' => Carbon::now()->subMonths(rand(1,6))]);
    $path = public_path() . '/' . getenv('APP_UPLOADS') . '/visuals/' . $user->id;
    File::makeDirectory($path);
    $image = $faker->image($path, 1900, 1080, 'abstract', false);

    // thumbnail
    Image::make($path . '/' . $image)
        ->resize(410, null, function ($constraint) {
            $constraint->aspectRatio();
        })
        ->save($path . '/' . 'thumb_' . $image);

    // twitter banner
    Image::make($path . '/' . $image)
        ->resize(1500, 500)
        ->save($path . '/' . 'twitter_' . $image);

    //facebook banner
    Image::make($path . '/' . $image)
        ->resize(828, 315)
        ->save($path . '/' . 'fb_' . $image);

    return [
        'user_id' => $user->id,
        'track'   => $faker->words(2, true),
        'album'   => $faker->words(2, true),
        'artist'  => $faker->name,
        'image'   => $image,
    ];
});

$factory->define(App\Blog::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 1,
        'title'   => $faker->words(2, true),
        'body'    => $faker->paragraph(10, true),
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    $visuals = Visual::all();
    $users = User::all();

    return [
        'user_id' => $users->random()->id,
        'visual_id' => $visuals->random()->id,
        'body' => $faker->paragraph()
    ];
});
