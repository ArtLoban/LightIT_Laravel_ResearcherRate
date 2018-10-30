<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
//    'middleware' => 'auth'
], function() {
    Route::resource('/', 'DashboardController');
    Route::resource('/dashboard', 'DashboardController');
    Route::resource('/users', 'UserController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
