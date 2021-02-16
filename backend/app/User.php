<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Post;
use App\Comment;
use App\Following;
use App\Like;

class User extends Authenticatable
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function followings()
    {
        return $this->hasMany(Following::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function findFollowingUser(User $following_user)
    {
        return $this->followings()->where('following_user_id', $following_user->id)->first();
    }
}
