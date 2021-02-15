<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use App\Comment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{

    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setup();
        $this->user = factory(User::class)->create();
    }

    public function testStore()
    {
        $post = factory(Post::class)->create();
        $before_comments_table_count = Comment::all()->count();
        $response = $this->actingAs($this->user)->from("post/$post->id")->post("post/$post->id/comment", ['text' => 'コメントコメント', "post" => $post]);
        $response->assertStatus(302);
        $this->assertEquals(Comment::all()->count(), $before_comments_table_count + 1);
    }

    public function testStoreRedirectWithoutLogging()
    {
        $post = factory(Post::class)->create();
        $before_comments_table_count = Comment::all()->count();
        $response = $this->from("post/$post->id")->post("post/$post->id/comment", ['text' => 'コメントコメント', "post" => $post]);
        $response->assertStatus(302);
        $this->assertEquals(Comment::all()->count(), $before_comments_table_count); 
    }
}
