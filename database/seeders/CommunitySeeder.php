<?php

namespace Database\Seeders;

use App\Models\Community;
use Illuminate\Database\Seeder;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = Community::factory()->list();
        $first = array_splice($list, 0, 2000);
        $second = array_splice($list, 0, 2000);
        $third = array_splice($list, 0, 2000);
        $others = array_splice($list, 0);
        Community::insert($first);
        Community::insert($second);
        Community::insert($third);
        Community::insert($others);

    }
}
