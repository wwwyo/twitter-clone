<?php

namespace Tests\Feature;

use App\User;
use App\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{

    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    public function testDisplayedPostsInIndex()
    {
        $post1 = factory(Post::class)->create();
        $post2 = factory(Post::class)->create();
        $response = $this->actingAs($this->user)->get('/post');
        $response->assertStatus(200);
        $response->assertSee($post1->text);
        $response->assertSee($post2->text);
    }

    public function testIndexRedirectWithoutLogging()
    {
        $response = $this->get('/post');
        $response->assertStatus(302);
    }

    public function testDisplayedPostShow()
    {
        $post = factory(Post::class)->create();
        $response = $this->actingAs($this->user)->get("/post/$post->id");
        $response->assertStatus(200);
        $response->assertSee($post->text);
    }

    public function testShowRedirectWithoutLogging()
    {
        $post = factory(Post::class)->create();
        $response = $this->get("post/$post->id");
        $response->assertStatus(302);
    }

    public function testCreate()
    {
        $response = $this->actingAs($this->user)->get("post/create");
        $response->assertStatus(200);
    }

    public function testCreateRedirectWithoutLogging()
    {
        $response = $this->get("post/create");
        $response->assertStatus(302);
    }

    public function testStore()
    {
        $before_posts_table_count = Post::all()->count();
        $response = $this->actingAs($this->user)->from('/post/create')->post('/post', ['text' => 'テキストテキスト', 'user_id' => $this->user->id]);
        $response->assertStatus(302);
        $this->assertEquals(Post::all()->count(), $before_posts_table_count + 1);
    }

    public function testStoreRedirectWithoutLogging()
    {
        $before_posts_table_count = Post::all()->count();
        $response = $this->post('/post', ['text' => 'テキストテキスト', 'user_id' => $this->user->id]);
        $response->assertStatus(302);
        $this->assertEquals(Post::all()->count(), $before_posts_table_count);
    }

    public function testEdit()
    {
        $post = factory(Post::class)->make();
        $post->user_id = $this->user->id;
        $post->save();
        $response = $this->actingAs($this->user)->get("/post/$post->id/edit");
        $response->assertStatus(200);
        $response->assertSee($post->text);
    }

    public function testEditRedirectWithoutLogging()
    {
        $post = factory(Post::class)->create();
        $response = $this->get("/post/$post->id/edit");
        $response->assertStatus(302);
    }

    public function testEditNotOwnPost()
    {
        $post = factory(Post::class)->create();
        $response = $this->actingAs($this->user)->get("/post/$post->id/edit");
        $response->assertStatus(302);
    }

    public function testUpdate()
    {
        $post = factory(Post::class)->make();
        $post->user_id = $this->user->id;
        $post->save();
        $response = $this->actingAs($this->user)->patch("/post/$post->id", ["text" => "変更変更"]);
        $response->assertStatus(302);
        $response->assertDontSee($post->text);
    }

    public function testUpdateRedirectWithoutLogging()
    {
        $post = factory(Post::class)->create();
        $response = $this->patch("/post/$post->id", ["text" => "変更変更"]);
        $response->assertStatus(302);
    }

    public function testUpdateNotOwnUpdate()
    {
        $post = factory(Post::class)->create();
        $response = $this->actingAs($this->user)->patch("/post/$post->id", ["text" => "変更変更"]);
        $response->assertStatus(302); 
    }

    public function testDelete()
    {
        $post = factory(Post::class)->make();
        $post->user_id = $this->user->id;
        $post->save();
        $before_posts_table_count = Post::all()->count();
        $response = $this->actingAs($this->user)->delete("/post/$post->id");
        $response->assertStatus(302);
        $this->assertEquals(Post::all()->count(), $before_posts_table_count - 1);
    }

    public function testDeleteRedirectWithoutLogging()
    {
        $post = factory(Post::class)->make();
        $post->user_id = $this->user->id;
        $post->save();
        $before_posts_table_count = Post::all()->count();
        $response = $this->delete("/post/$post->id");
        $response->assertStatus(302);
        $this->assertEquals(Post::all()->count(), $before_posts_table_count);
    }

    public function testDeleteNotOwnUpdate()
    {
        $post = factory(Post::class)->create();
        $before_posts_table_count = Post::all()->count();
        $response = $this->actingAs($this->user)->delete("/post/$post->id");
        $response->assertStatus(302);
        $this->assertEquals(Post::all()->count(), $before_posts_table_count);
    }
}
