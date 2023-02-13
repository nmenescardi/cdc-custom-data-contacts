<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TagRelationshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $taggable = [
            \App\Record::class,
            \App\Contact::class,
            \App\Story::class,
        ];

        foreach (range(50, 200) as $i) {

            $randomType = $faker->randomElement($taggable);
            $randomID = $randomType::all()->random(1)->first()->id;

            DB::table('taggables')->insert([
                'tag_id'        => App\Tag::all()->random(1)->first()->id,
                'taggable_id'   => $randomID,
                'taggable_type' => $randomType,
            ]);
        }
    }
}
