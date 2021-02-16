<?php

namespace Tests\Feature;

use App\User;
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
        $this->user = factory(User::class)->create();
    }

    public function testIndexHaveNotFollowing()
    {
        $following_user = factory(User::class)->create();
        $response = $this->actingAs($this->user)->get("user/$following_user->id/following", ["user" => $following_user]);
        $response->assertStatus(200);
        $response->assertSee('フォロー中のユーザーがいません');
    }

    public function testIndexHaveFollowingUser()
    {
        $following = factory(Following::class)->make();
        $following->user_id = $this->user->id;
        $following->save();
        $response = $this->actingAs($this->user)->get("user/$following->user_id/following", ["user" => $following->following_user]);
        $response->assertStatus(200);
        $response->assertSee($following->following_user->name);
    }

    public function testIndexRedirectWithoutLogging()
    {
        $following_user = factory(User::class)->create();
        $response = $this->get("user/$following_user->id/following", ["user" => $following_user]);
        $response->assertStatus(302);
    }

    public function testStore()
    {
        $following_user = factory(User::class)->create();
        $before_followings_table_count = Following::all()->count();
        $response = $this->actingAs($this->user)->from("user/$following_user->id")->post("user/$following_user->id/following" , ['user' => $following_user]);
        $response->assertStatus(302);
        $this->assertEquals(Following::all()->count(), $before_followings_table_count + 1);
    }

    public function testStoreDontOwnFollowing()
    {
        $following_user = factory(User::class)->create();
        $before_followings_table_count = Following::all()->count();
        $response = $this->actingAs($following_user)->from("user/$following_user->id")->post("user/$following_user->id/following" , ['user' => $following_user]);
        $response->assertStatus(302);
        $this->assertEquals(Following::all()->count(), $before_followings_table_count);
    }

    public function testStoreRedirectWithoutLogging()
    {
        $following_user = factory(User::class)->create();
        $before_followings_table_count = Following::all()->count();
        $response = $this->from("user/$following_user->id")->post("user/$following_user->id/following" , ['user' => $following_user]);
        $response->assertStatus(302);
        $this->assertEquals(Following::all()->count(), $before_followings_table_count);
    }

    public function testDelete()
    {
        $following = factory(Following::class)->make();
        $following->user_id = $this->user->id;
        $following->save();
        $before_followings_table_count = Following::all()->count();
        $response = $this->actingAs($this->user)->from("user/$following->user_id")->delete("user/$following->following_user_id/following" , ['user' => $following->following_user]);
        $response->assertStatus(302);
        $this->assertEquals(Following::all()->count(), $before_followings_table_count - 1);
    }

    public function testDeleteRedirectWithoutLogging()
    {
        $following = factory(Following::class)->create();
        $before_followings_table_count = Following::all()->count();
        $response = $this->from("user/$following->user_id")->delete("user/$following->following_user_id/following" , ['user' => $following->following_user]);
        $response->assertStatus(302);
        $this->assertEquals(Following::all()->count(), $before_followings_table_count); 
    }
}
