<?php

namespace Tests\Unit;

use App\User;
use App\Following;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    public function testFactory()
    {
        $user = factory(User::class)->create();
        $this->assertDatabaseHas('users', ['name' => $user->name, 'email' => $user->email, 'password' => $user->password]);
    }

    public function testFindFollowingUser()
    {
        $following = factory(Following::class)->make();
        $following->user_id = $this->user->id;
        $following->save();
        $response = $this->user->findFollowingUser($following->following_user);
        $this->assertTrue(is_object($response));
    }

    public function testDontFollowingUser()
    {
        $not_following_user = factory(User::class)->create();
        $response = $this->user->findFollowingUser($not_following_user);
        $this->assertNull($response);
    }
}
