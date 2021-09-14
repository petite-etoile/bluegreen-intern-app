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

        $new_name = User::factory()->make()->name;
        UserService::edit_name([
            'name' => $new_name,
            'user_id' => $user_id,
        ]);

        $user = User::find($user_id);
        $this->assertSame($user->name, $new_name);
    }

    /**
     * A unit test for editing name
     *
     * @return void
     */
    public function test_edit_email(): void
    {
        $user = User::factory()->create();
        $user_id = $user->id;

        $new_email = User::factory()->make()->email;
        UserService::edit_email([
            'email' => $new_email,
            'user_id' => $user_id,
        ]);

        $user = User::find($user_id);
        $this->assertSame($user->email, $new_email);
    }

    /**
     * A unit test for editing introduction
     *
     * @return void
     */
    public function test_edit_introduction(): void
    {
        $user = User::factory()->create();
        $user_id = $user->id;

        $new_introduction = User::factory()->make()->introduction;
        UserService::edit_introduction([
            'introduction' => $new_introduction,
            'user_id' => $user_id,
        ]);

        $user = User::find($user_id);
        $this->assertSame($user->introduction, $new_introduction);
    }
}
