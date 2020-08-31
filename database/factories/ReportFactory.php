<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Content;
use App\Report;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$keep_id = Str::random(16);

// Report
$factory->define(Report::class, function (Faker $faker) {
    global $keep_id;
    return [
        'id' => $keep_id,
        'user_id' => fn () => factory(App\User::class)->create()->id,
        'report_title' => 'テストタイトル',
        'about' => 'テスト副題',
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime(),
    ];
});

// Content
$factory->define(Content::class, function (Faker $faker) {
    global $keep_id;
    return [
        'report_id' => $keep_id,
        'content' => substr($faker->text, 150, 250),
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime(),
    ];
});
