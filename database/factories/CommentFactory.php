<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'comment' => substr($faker->text, 0, 500),
        'user_id' => fn() => factory(App\User::class)->create()->id,
    ];
});

