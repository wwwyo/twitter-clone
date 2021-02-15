<?php

namespace Tests\Feature;

use App\User;
use App\Post;
use App\Like;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LikeTest extends TestCase
{

    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    public function testStore()
    {
        $post = factory(Post::class)->create();
        $before_likes_table_count = Like::all()->count();
        $response = $this->actingAs($this->user)->from("/post/$post->id")->post("post/$post->id/like" , ['post' => $post]);
        $response->assertStatus(302);
        $this->assertEquals(Like::all()->count(), $before_likes_table_count + 1);
    }

    public function testStoreRedirectWithoutLogging()
    {
        $post = factory(Post::class)->create();
        $before_likes_table_count = Like::all()->count();
        $response = $this->from("/post/$post->id")->post("post/$post->id/like" , ['post' => $post]);
        $response->assertStatus(302);
        $this->assertEquals(Like::all()->count(), $before_likes_table_count);
    }

    public function testDelete()
    {
        $like = factory(Like::class)->create();
        $before_likes_table_count = Like::all()->count();
        $response = $this->actingAs($this->user)->from("/post/$like->post_id")->delete("post/like/$like->id", ["like" => $like]);
        $response->assertStatus(302);
        $this->assertEquals(Like::all()->count(), $before_likes_table_count - 1);
    }

    public function testDeleteRedirectWithoutLogging()
    {
        $like = factory(Like::class)->create();
        $before_likes_table_count = Like::all()->count();
        $response = $this->from("/post/$like->post_id")->delete("post/like/$like->id", ["like" => $like]);
        $response->assertStatus(302);
        $this->assertEquals(Like::all()->count(), $before_likes_table_count);
    }
}
