<?php

Route::get('/', 'CategoryController@index')->name('welcome');
Route::post('/', 'CategoryController@create');

Route::get('/region', 'RegionController@index')->name('region');
Route::get('/region/json', 'RegionController@json')->name('region');
Route::post('/region', 'RegionController@create')->name('create');