<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Post;

class Like extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
    ];

    public function users()
    {
        $this->belongsTo(User::class);
    }

    public function posts()
    {
        $this->belongsTo(Post::class);
    }
}
