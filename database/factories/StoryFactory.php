<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Story;
use Faker\Generator as Faker;

$factory->define(Story::class, function (Faker $faker) {
    return [
        'title'             => $faker->realText(50),
        'description'       => $faker->optional(0.9, null)->realText(500),
        'days_to_expire'    => $faker->numberBetween(2, 45)
    ];
});
