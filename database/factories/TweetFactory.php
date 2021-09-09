<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Tweet;
use Illuminate\Database\Eloquent\Factories\Factory;

class TweetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tweet::class;
    
    /**
     * The counter of tweet num
     *
     * @var integer
     */
    private static $tweet_counter = 1;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tweet_text' => $this->faker->sentence,
            'user_id' => User::factory(),
            'root_tweet_id' => function () { return self::$tweet_counter++; },
        ];
    }
}