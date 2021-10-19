<?php

use Illuminate\Support\Facades\Route;


Route::get('/roles', 'RoleController@index')->name('role.index');
Route::post('/roles', 'RoleController@store')->name('role.store');
Route::delete('/roles/{role}/destroy', 'RoleController@destroy')->name('role.destroy');
