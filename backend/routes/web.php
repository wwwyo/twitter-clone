<?php

Route::get('/', function () {
    return redirect()->route('post.index');
});

Auth::routes();

Route::resource('/post', 'PostController');
