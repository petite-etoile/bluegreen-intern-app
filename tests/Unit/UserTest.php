<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Follow;
use App\Http\Services\UserService;
use Illuminate\Support\Facades\DB;

class UserTest extends TestCase
{
    /**
     * A unit test for getting follow info
     *
     * @return void
     */
    public function test_get_follow_info(): void
    {
        $follow = Follow::factory()->create();
        Follow::factory()->count(30)->create();
        $following_user_id = $follow->following_user_id;

        $users = UserService::get_follow_users($following_user_id);

        foreach($users as $user){
            $followed_user_id = $user->id;
            $is_following = DB::table('follows')
                ->where('following_user_id', $following_user_id)
                ->where('followed_user_id', $followed_user_id)
                ->count() == 1;

            $this->assertSame(!is_null($user->followed_user_id), $is_following);
        }
    }

}