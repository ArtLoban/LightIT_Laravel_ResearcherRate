<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'middleware' => 'auth',
    'prefix' => 'admin',
    'namespace' => 'Admin',
], function() {
    Route::resource('/', 'DashboardController');
    Route::resource('/dashboard', 'DashboardController');
    Route::resource('/users', 'Users\UserController');
    Route::resource('/roles', 'Users\RoleController');
    Route::resource('/permissions', 'Users\PermissionController');
    Route::resource('/assign_permissions', 'Users\AssignPermissionController');
    Route::resource('/blank_users', 'Users\BlankUserController');
    Route::resource('/faculties', 'Organization\Facility\FacultyController');
    Route::resource('/departments', 'Organization\Facility\DepartmentController');
    Route::resource('/profiles', 'Organization\Employees\ProfileController');
    Route::resource('/positions', 'Organization\Employees\PositionController');
    Route::resource('/academic_degrees', 'Organization\Employees\AcademicDegreeController');
    Route::resource('/academic_titles', 'Organization\Employees\AcademicTitleController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::fallback(function () {
    print '<h1>404 -> Fallback route</h1>';
});
