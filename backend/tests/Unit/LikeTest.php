<?php

namespace Tests\Unit;

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
        $this->like = factory(Like::class)->create();
    }

    public function testFactory()
    {
        $like = factory(Like::class)->create();
        $this->assertDatabaseHas('likes', ['user_id' => $like->user_id, 'post_id' => $like->post_id]);
    }
}
