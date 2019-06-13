<?php

use App\Models\Replay;
use App\Models\Topic;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Replay::class, function (Faker $faker) {
    $user_ids = User::all()->pluck('id')->toArray();
    $topic_ids = Topic::all()->pluck('id')->toArray();

    return [
        'content' => $faker->sentence(),
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime(),
        'topic_id' => $faker->randomElement($topic_ids),
        'from_user' => $faker->randomElement($user_ids),
        'to_user' => 0,
    ];
});
