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
    Route::resource('/roles', 'Users\RoleController');
    Route::resource('/permissions', 'Users\PermissionController');
    Route::resource('/faculties', 'Organization\Facility\FacultyController');
    Route::resource('/departments', 'Organization\Facility\DepartmentController');
    Route::resource('/profiles', 'Organization\Employees\ProfileController');
    Route::resource('/positions', 'Organization\Employees\PositionController');
    Route::resource('/academic_degrees', 'Organization\Employees\AcademicDegreeController');
    Route::resource('/academic_titles', 'Organization\Employees\AcademicTitleController');
    Route::resource('/blank_users', 'Users\BlankUserController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
