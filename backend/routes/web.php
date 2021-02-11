<?php

Route::get('/', function () {
    return redirect()->route('post.index');
});

Auth::routes();

Route::get('/user/{id}', 'UserController@show')->name('user.show');
Route::resource('/post', 'PostController');
Route::resource('/comment', 'CommentController')->only('update');
