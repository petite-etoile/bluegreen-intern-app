<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Tweet;
use App\Models\User;
use App\Models\Follow;
use App\Http\Services\FollowService;
use Illuminate\Support\Facades\DB;

class FollowTest extends TestCase
{
    /**
     * A unit test for checking a follow.
     *
     * @return void
     */
    public function test_checking_exist_follow(): void
    {

        // テスト用データの用意
        $follow = Follow::factory()->create();
        $following_user_id = $follow->following_user_id;
        $followed_user_id = $follow->followed_user_id;

        $this->assertTrue( FollowService::is_following([
            'following_user_id' => $following_user_id,
            'followed_user_id' => $followed_user_id,
        ]));
    }

    /**
     * A unit test for checking a non-follow.
     *
     * @return void
     */
    public function test_checking_not_exist_follow(): void
    {

        // テスト用データの用意
        $follow = Follow::factory()->make();
        $following_user_id = $follow->following_user_id;
        $followed_user_id = $follow->followed_user_id;

        $this->assertFalse( FollowService::is_following([
            'following_user_id' => $following_user_id,
            'followed_user_id' => $followed_user_id,
        ]));
    }

    /**
     * A unit test for folloing
     *
     * @return void
     */
    public function test_following(): void
    {

        // テスト用データの用意
        $follow = Follow::factory()->make();
        $following_user_id = $follow->following_user_id;
        $followed_user_id = $follow->followed_user_id;

        $record_num_before = Follow::count();

        FollowService::follow([
            'following_user_id' => $following_user_id,
            'followed_user_id' => $followed_user_id,
        ]);

        $record_num_after = Follow::count();
        $this->assertSame($record_num_before + 1, $record_num_after);
    }

    /**
     * A unit test for unfolloing
     *
     * @return void
     */
    public function test_unfollowing(): void
    {

        // テスト用データの用意
        $follow = Follow::factory()->create();
        $following_user_id = $follow->following_user_id;
        $followed_user_id = $follow->followed_user_id;

        $record_num_before = Follow::count();

        FollowService::unfollow([
            'following_user_id' => $following_user_id,
            'followed_user_id' => $followed_user_id,
        ]);

        $record_num_after = Follow::count();
        $this->assertSame($record_num_before - 1, $record_num_after);
    }

}
