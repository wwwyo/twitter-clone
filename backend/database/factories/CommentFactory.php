<?php

use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'text' => $faker->text(300),
        'user_id' => function() {
            return factory(User::class)->create()->id;
        },
        'post_id' => function() {
            return factory(Post::class)->create()->id;
        },
    ];
});
