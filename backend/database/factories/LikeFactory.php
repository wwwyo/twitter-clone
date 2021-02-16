<?php

use Faker\Generator as Faker;
use App\User;
use App\Post;

$factory->define(App\Like::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory(User::class)->create()->id;
        },
        'post_id' => function() {
            return factory(Post::class)->create()->id;
        }
    ];
});
