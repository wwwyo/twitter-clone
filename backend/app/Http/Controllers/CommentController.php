<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Post $post, Request $request)
    {
        $params = $request->validate([
            'text' => 'required|max:300',
        ]);

        $user_id = Auth::id();

        $comment = new Comment();
        $comment->text = $request->text;
        $comment->user_id = $user_id;
        $comment->post_id = $post->id;
        $comment->save();
        return redirect()->route('post.show', $comment->post);
    }

}
