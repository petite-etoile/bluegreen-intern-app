<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tweet;

class TweetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tweet::factory()->count(100)->create();
    }
}
