<?php

Route::get('/', function () {
    return redirect()->route('post.index');
});

Auth::routes();

Route::get('/user/{id}', 'UserController@show')->name('user.show');
Route::get('/user/{id}/like', 'UserController@showLike')->name('user.showLike');

Route::group(['prefix' => 'user'], function() {
    Route::get('{user}/following', 'FollowingController@index')->name('following.index');
    Route::post('{user}/following', 'FollowingController@store')->name('following.store');
    Route::delete('{user}/following', 'FollowingController@destroy')->name('following.destroy');
});

Route::resource('/post', 'PostController');
Route::group(['prefix' => 'post'], function() {
    Route::post('{post}/comment', 'CommentController@store')->name('comment.store');
    Route::post('{post}/like', 'LikeController@store')->name('like.store');
    Route::delete('like/{like}', 'LikeController@destroy')->name('like.destroy');
});

