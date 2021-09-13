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
     * The user index for follow's factory
     *
     * @var integer
     */
    public static $user_id1 = 1;

    /**
     * The user index for follow's factory
     *
     * @var integer
     */
    public static $user_id2 = 0;

    /**
     * Define the model's default state.
     * For a user whose id is odd number, this factory make it follow another user whose id is even number.
     * For a user whose id is even number, this factory make it follow another user whose id is odd number.
     *
     * @return array
     */
    public function definition()
    {   
        self::$user_id2+=2;
        if(self::$user_id2 > User::count()){
            self::$user_id1++;
            self::$user_id2 = self::$user_id1&1 ? 2 : 1; // If user_id1 is odd, set user_id2 2. Else set user_id2 1.
            
            // If there is a shortage of users, add User.
            if(self::$user_id1 > User::count()){
                User::factory()->create();
            }
        }
        return [
            'following_user_id' => self::$user_id1,
            'followed_user_id' => self::$user_id2,
        ];
    }
}
