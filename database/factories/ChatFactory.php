<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Chat::class, function (Faker $faker) {
    return [
        'user_id' => rand(1, 1000),
        'message' => $faker->realText(),
        'group_id' => rand(1, 1000)
    ];
});
