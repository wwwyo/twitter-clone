<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('filter_own_post', [
            'only' => [
                'edit', 'update', 'destroy'
            ]
        ]);
    }

    public function index()
    {
        $posts = Post::with('user')->orderBy('created_at', 'desc')->get();
        return view('posts.index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostRequest $request)
    {
        $user_id = Auth::id();

        $post = new Post();
        $post->text = $request->text;
        $post->user_id = $user_id;
        $post->save();
        return redirect()->route('post.show', $post);
    }

    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $post->text = $request->text;
        $post->update();
        return redirect()->route('post.show', ['post' => $post]);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect(route('post.index'));
    }
}
