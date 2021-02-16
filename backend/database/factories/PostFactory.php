<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        "text" => $faker->text(300),
        "user_id" => function() {
            return factory(User::class)->create()->id;
        },
    ];
});
