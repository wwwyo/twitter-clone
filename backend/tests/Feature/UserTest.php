<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testRegister()
    {
        $before_user_table_count = User::all()->count();
        $response = $this->post('/register', ['name' => 'name', 'email' => 'test@email.com', 'password' => '123456', 'password_confirmation' => '123456']);
        $response->assertStatus(302);
        $this->assertEquals(User::all()->count(), $before_user_table_count + 1);
    }

    public function testLogin()
    {
        $user = factory(User::class)->create();
        $before_user_table_count = User::all()->count();
        $response = $this->post('/login', ['email' => $user->email, 'password' => $user->password]);
        $response->assertStatus(302);
        $this->assertEquals(User::all()->count(), $before_user_table_count);
    }

    public function testLogout()
    {
        $user = factory(User::class)->create();
        $before_user_table_count = User::all()->count();
        $response = $this->post('/logout', [$user]);
        $response->assertStatus(302);
        $this->assertEquals(User::all()->count(), $before_user_table_count); 
    }

    public function testShowOwnPage()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get("user/$user->id");
        $response->assertStatus(200);
        $response->assertSee('ログアウト');
    }

    public function testShowDontOwnPage()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();
        $response = $this->actingAs($user1)->get("user/$user2->id");
        $response->assertStatus(200);
        $response->assertSee('フォローする');
    }

    public function testShowLikeOwnPage()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get("user/$user->id/like");
        $response->assertStatus(200);
        $response->assertSee('ログアウト');
    }

    public function testShowLikeDontOwnPage()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();
        $response = $this->actingAs($user1)->get("user/$user2->id/like");
        $response->assertStatus(200);
        $response->assertSee('フォローする');
    }
}
