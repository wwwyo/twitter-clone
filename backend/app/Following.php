<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Following extends Model
{
    protected $fillable = [
        'user_id',
        'following_user_id',
    ];

    public function following_user()
    {
        return $this->belongsTo(User::class, 'following_user_id');
    }
}