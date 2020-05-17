<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Record;
use Faker\Generator as Faker;

$factory->define(Record::class, function (Faker $faker) {
    return [
        'contact_id' => App\Contact::all()->random(1)->first()->id,
        'title' => $faker->realText(50),
        'description' => $faker->optional(0.9, null)->realText(500)  // 10% chance of null
    ];
});
