<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\post;

class Comment extends Model
{
    protected $fillable = [
        'text',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
