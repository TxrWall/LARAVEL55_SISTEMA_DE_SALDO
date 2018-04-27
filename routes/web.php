<?php

Route::group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function() {

    // withdraw
    Route::post('withdraw', 'BalanceController@withdrawStore')->name('withdraw.store');
    Route::get('withdraw', 'BalanceController@withdraw')->name('balance.withdraw');

    // deposit
    Route::post('deposit', 'BalanceController@depositStore')->name('deposit.store');
    Route::get('deposit', 'BalanceController@deposit')->name('balance.deposit');
    Route::get('balance', 'BalanceController@index')->name('admin.balance');

    // home
    Route::get('/', 'AdminController@index')->name('admin');
});


Route::get('/', 'SiteController@index')->name('home');

Auth::routes();
