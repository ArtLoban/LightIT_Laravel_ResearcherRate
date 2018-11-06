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
    Route::resource('/users', 'Admin\Users\UserController');
    Route::resource('/roles', 'Admin\Users\RoleController');
    Route::resource('/permissions', 'Admin\Users\PermissionController');
    Route::resource('/blank_users', 'Admin\Users\BlankUserController');
    Route::resource('/faculties', 'Admin\Organization\Facility\FacultyController');
    Route::resource('/departments', 'Admin\Organization\Facility\DepartmentController');
    Route::resource('/profiles', 'Admin\Organization\Employees\ProfileController');
    Route::resource('/positions', 'Admin\Organization\Employees\PositionController');
    Route::resource('/academic_degrees', 'Admin\Organization\Employees\AcademicDegreeController');
    Route::resource('/academic_titles', 'Admin\Organization\Employees\AcademicTitleController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
