<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Post;
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

$factory->define(Post::class, function (Faker $faker) {
    $updatedAt = (new DateTime)->modify(rand(-99999, 99999).' minutes');
    $availableOn = $updatedAt->modify('+'.rand(0, 99999). ' minutes');
    return [
        'title' => substr($faker->sentence(8), 0, -1),
        'content' => $faker->paragraphs(3, true),
        'status' => $faker->randomElement([0, 1]),
        'visibility' => $faker->randomElement([0, 1, 2]),
        'available_on' => $availableOn,
        'updated_at' => $updatedAt,
    ];
});
