<?php

Route::get('/', function () {
    return redirect()->route('post.index');
});

Auth::routes();

Route::get('/user/{id}', 'UserController@show')->name('user.show');
Route::resource('/post', 'PostController');

Route::group(['prefix' => 'post'], function() {
    Route::resource('{post}/comment', 'CommentController')->only('store');
});
