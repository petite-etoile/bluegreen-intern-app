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
     * The user index for Tweet's factory
     *
     * @var integer
     */
    public static $user_id = 0;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
        self::$user_id++;
        if(self::$user_id > User::count()){
            if(User::count() == 0){
                self::$user_id = User::factory()->create()->id;
            }else{
                self::$user_id = 1;
            }
        }
        return [
            'tweet_text' => $this->faker->sentence,
            'user_id' => self::$user_id,
        ];
    }
}
