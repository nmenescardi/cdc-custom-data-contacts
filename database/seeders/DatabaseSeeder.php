<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
        $this->call(RecordsTableSeeder::class);
        $this->call(StoriesTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(TagRelationshipsTableSeeder::class);
    }
}
