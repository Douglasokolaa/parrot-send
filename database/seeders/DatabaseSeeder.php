<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call(CountrySeeder::class);
        $this->call(StateSeeder::class);
        $this->call(LgaSeeder::class);
//        $this->call(CommunitySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PhonebookSeeder::class);
        $this->call(ContactSeeder::class);
        $this->call(MessageSeeder::class);
    }
}
