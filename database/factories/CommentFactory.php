<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => fn() => factory(App\User::class)->create()->id,
        'comment' => substr($faker->text, 1, 250),
    ];
});

