<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Enums\TagColor;
use App\Tag;
use Faker\Generator as Faker;

$factory->define(Tag::class, function (Faker $faker) {
    return [
        'name'  => $faker->unique()->word(),
        'color' => 'red'
    ];
});
