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
}
