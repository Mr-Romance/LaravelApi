<?php

use App\Models\User;
use  App\Models\Category;
use Faker\Generator as Faker;

$factory->define(App\Models\Topic::class, function (Faker $faker) {
    // 获取所有的user_id
    $all_user_ids = User::all()->pluck('id')->toArray();
    if (empty($all_user_ids)) {
        exit('请先生成用户表数据');
    }

    // 获取所有的分类id
    $all_category_ids = Category::all()->pluck('id')->toArray();
    if (empty($all_category_ids)) {
        exit('请先生成分类表数据');
    }

    return [
        'title' => $faker->unique()->text(10),
        'body' => $faker->unique()->text(50),
        'user_id' => $faker->randomElement($all_user_ids),
        'category_id' => $faker->randomElement($all_category_ids),
        'reply_count' => $faker->randomNumber(),
        'view_count' => $faker->randomNumber(),
        'last_reply_user_id' => $faker->randomElement($all_user_ids),
        'order' => $faker->randomNumber(),
        'created_at' => now(),
        'updated_at' => now()
    ];
});
