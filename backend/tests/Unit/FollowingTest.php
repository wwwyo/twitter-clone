<?php

namespace Tests\Unit;

use App\Following;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FollowingTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->following = factory(Following::class)->create();
    }

    public function testFactory()
    {
        $following = factory(Following::class)->create();
        $this->assertDatabaseHas('followings', ['user_id' => $following->user_id, 'following_user_id' => $following->following_user_id]);
    } 
}
