<?php

namespace Database\Factories;

use App\Models\Like;
use App\Models\User;
use App\Models\Tweet;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Like::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tweet_id' => Tweet::factory(),
            'user_id' => User::factory(),
        ];
    }
}
