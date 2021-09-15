<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Http\Services\UserService;

class UserTest extends TestCase
{
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

}
