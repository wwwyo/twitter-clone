<?php

namespace Tests\Unit;

use App\User;
use App\Post;
use App\Like;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->post = factory(Post::class)->create();
    }

    public function testFactory()
    {
        $post = factory(Post::class)->create();
        $this->assertDatabaseHas('posts', ['text' => $post->text, 'user_id' => $post->user_id]);
    }

    public function testFindLikeId()
    {
        $like = factory(Like::class)->make();
        $like->post_id = $this->post->id;
        $like->save();
        $response = $this->post->findLikeId($like->user);
        $this->assertTrue(is_object($response));
    }

    public function testDontFindLikeId()
    {
        $response = $this->post->findLikeId($this->post->user);
        $this->assertNull($response);
    }

    public function testIsPostOwner()
    {
        $this->assertTrue($this->post->isPostOwner($this->post->user));
    }

    public function testDontIsPostOwner()
    {
        $user = factory(User::class)->create();
        $this->assertFalse($this->post->isPostOwner($user));
    }
}
