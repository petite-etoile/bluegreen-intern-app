<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Database\Eloquent\Factories\Factory;

class FollowFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Follow::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'following_user_id' => User::factory(),
            'followed_user_id' => User::factory(),
        ];
    }
}
