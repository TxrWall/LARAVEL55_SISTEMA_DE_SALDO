<?php

Route::group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function() {

    //history
    Route::any('history-search', 'BalanceController@searchHistories')->name('history.search');
    Route::get('history', 'BalanceController@history')->name('admin.history');

    // transfer
    Route::post('transfer', 'BalanceController@transferStore')->name('transfer.store');
    Route::post('confirm-transfer', 'BalanceController@confirmTransfer')->name('confirm.transfer');
    Route::get('transfer', 'BalanceController@transfer')->name('balance.transfer');

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

// index
Route::post('atualizar-perfil', 'Admin\UserController@profileUpdate')->name('profile.update')->middleware('auth');
Route::get('meu-perfil', 'Admin\UserController@profile')->name('profile')->middleware('auth');

Route::get('/', 'SiteController@index')->name('home');

Auth::routes();
