<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $params = $request->validate([
            'text' => 'required|max:300',
        ]);

        if (Auth::check()) {
            $user_id = Auth::id();

        $post = new Post();
        $post->text = $request->text;
        $post->user_id = $user_id;
        $post->save();
        return redirect()->route('post.show', $post);
        }
    }

    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request, Post $post)
    {
        $params = $request->validate([
            'text' => 'required|max:300'
        ]);
        $post->update($params);
        return redirect()->route('post.show', ['post' => $post]);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect(route('post.index'));
    }
}
