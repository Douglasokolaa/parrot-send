<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->withPersonalTeam()->create([
            'name' => 'Admin',
            'email' => 'admin@parrot.test',
            'password' => Hash::make('password'),
        ]);
    }
}
