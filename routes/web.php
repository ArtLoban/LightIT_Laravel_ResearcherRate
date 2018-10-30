<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'prefix' => 'admin',
//    'middleware' => 'auth'
], function() {
    Route::resource('/', 'Admin\DashboardController');
    Route::resource('/dashboard', 'Admin\DashboardController');
    Route::resource('/users', 'Users\UserController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
