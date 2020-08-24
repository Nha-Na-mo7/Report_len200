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
        'content' => '或日の暮方の事である。一人の下人が、羅生門の下で雨やみを待つてゐた。
廣い門の下には、この男の外に誰もゐない。唯、所々丹塗の剥げた、大きな圓柱に、蟋蟀が一匹とまつてゐる。
羅生門が、朱雀大路にある以上は、この男の外にも、雨やみをする市女笠や揉烏帽子が、もう二三人にんはありさうなものである。
それが、この男の外には誰もゐない。',
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime(),
    ];
});
