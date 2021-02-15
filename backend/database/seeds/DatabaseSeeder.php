<?php

use App\User;
use App\Post;
use App\Comment;
use App\Following;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 5)->create()->each(function ($user) {
            factory(Comment::class, 3)->create(['user_id' => $user->id]);
            factory(Following::class, 2)->create(['user_id' => $user->id]);
        });
    }
}
