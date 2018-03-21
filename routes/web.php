<?php

Route::group(['middleware' => ['auth'], 'namespace' => 'Admin'], function() {
    Route::get('admin', 'AdminController@index')->name('admin');
});


Route::get('/', 'SiteController@index')->name('home');

Auth::routes();
