<?php

use Illuminate\Support\Facades\Route;


Route::get('/post/{post}', 'PostController@show')->name('post');
Route::get('/posts/create', 'PostController@create')->name('post.create');
Route::post('/posts', 'PostController@store')->name('post.store');
Route::get('/posts', 'PostController@index')->name('post.index');
Route::delete('/post/{post}/destroy', 'PostController@destroy')->name('post.destroy');
Route::get('/post/{post}/edit', 'PostController@edit')->name('post.edit');
Route::patch('/post/{post}/update','PostController@update')->name('post.update');