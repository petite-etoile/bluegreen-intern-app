<?php

namespace Database\Factories;

use App\Models\Reply;
use App\Models\User;
use App\Models\Tweet;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reply::class;

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
            'tweet_id' => Tweet::factory(),
        ];
    }
}
