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

    /**
     * A unit test for editing name
     *
     * @return void
     */
    public function test_edit_name(): void
    {
        $user = User::factory()->create();
        $user_id = $user->id;

        $new_user = User::factory()->make();
        $new_name = $new_user->name;
        $new_email = $new_user->email;
        $new_introduction = $new_user->introduction;

        UserService::edit_user_info([
            'user_id' => $user_id,
            'name' => $new_name,
            'email' => $new_email,
            'introduction' => $new_introduction,
        ]);

        $user = User::find($user_id);
        $this->assertSame($user->name, $new_name);
        $this->assertSame($user->email, $new_email);
        $this->assertSame($user->introduction, $new_introduction);
    }

    /**
     * A unit test for deleting user.
     *
     * @return void
     */
    public function test_deleting_user(): void
    {
        $user = User::factory()->create();
        $id = $user->id;

        $record_num_before = User::count();

        UserService::delete_user($id);

        $record_num_after = User::count();

        $this->assertSame($record_num_before - 1, $record_num_after);
    }
}
