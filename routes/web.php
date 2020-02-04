<?php

Route::get('/', 'CategoryController@index')->name('welcome');
Route::post('/', 'CategoryController@create')->name('create');