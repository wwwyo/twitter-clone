<?php

namespace Tests\Unit;

use App\Comment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->comment = factory(Comment::class)->create();
    }

    public function testFactory()
    {
        $comment = factory(Comment::class)->create();
        $this->assertDatabaseHas('comments', ['text' => $comment->text, 'user_id' => $comment->user_id, 'post_id' => $comment->post_id]);
    }
}
