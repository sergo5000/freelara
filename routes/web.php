<?php

Route::get('/', 'CategoryController@index')->name('welcome');
Route::post('/', 'CategoryController@create')->name('create');



Route::get('/upload', 'UploadFileController@index')->name('upload');
Route::post('/upload', 'UploadFileController@add')->name('add');