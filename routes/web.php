<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', 'IndexController@index')->name('/');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::group([
    'middleware' => ['auth', 'can:accessAdminPanel'],
    'prefix' => 'admin',
    'namespace' => 'Admin',
], function() {
    Route::resource('/', 'DashboardController');
    Route::resource('/dashboard', 'DashboardController');
    Route::resource('/users', 'Users\UserController')->middleware('can:fullAccess');
    Route::resource('/roles', 'Users\RoleController')->middleware('can:fullAccess');
    Route::resource('/permissions', 'Users\PermissionController')->middleware('can:fullAccess');
    Route::resource('/assign_permissions', 'Users\AssignPermissionController')->middleware('can:fullAccess');
    Route::resource('/assign_permissions', 'Users\AssignPermissionController')->middleware('can:fullAccess');
    Route::resource('/blank_users', 'Users\BlankUserController')->middleware('can:fullAccess');
    Route::resource('/faculties', 'Organization\Facility\FacultyController');
    Route::resource('/departments', 'Organization\Facility\DepartmentController');
    Route::resource('/profiles', 'Organization\Employees\ProfileController')->middleware('can:seeProfiles');;
    Route::resource('/positions', 'Organization\Employees\PositionController');
    Route::resource('/academic_degrees', 'Organization\Employees\AcademicDegreeController');
    Route::resource('/academic_titles', 'Organization\Employees\AcademicTitleController');
});

Route::group([
    'middleware' => 'auth',
    'prefix' => 'cabinet',
    'namespace' => 'Cabinet',
], function() {
    Route::get('/profile', 'ProfileController@index')->name('cabinet.profile');
    Route::get('/articles', 'ArticleController@index')->name('cabinet.articles');
    Route::get('/patents', 'PatentController@index')->name('cabinet.patents');
    Route::get('/theses', 'ThesisController@index')->name('cabinet.theses');
});

Route::fallback(function () {
    print '<h1>404 -> Fallback route</h1>';
});
