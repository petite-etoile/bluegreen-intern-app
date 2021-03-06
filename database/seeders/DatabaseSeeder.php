<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        $this->call(FollowsTableSeeder::class);
        $this->call(TweetsTableSeeder::class);
        $this->call(LikesTableSeeder::class);
        $this->call(RepliesTableSeeder::class);
    }
}
