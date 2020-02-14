<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Skybluesofa\Followers\Models\Follower;
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

$factory->define(Follower::class, function (Faker $faker) {
    $senderId = User::inRandomOrder()->first()->id;
    $recipientId = User::where('id', '!=', $senderId)->inRandomOrder()->first()->id;
    return [
        'sender_type' => User::class,
        'sender_id' => $senderId,
        'recipient_type' => User::class,
        'recipient_id' => $recipientId,
        'status' => rand(0, 3),
    ];
});
