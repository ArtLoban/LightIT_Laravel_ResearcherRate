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
    Route::get('/', 'ProfileController@index')->name('cabinet.profile');
    Route::get('/profile', 'ProfileController@index')->name('cabinet.profile');
    Route::put('/profile', 'ProfileController@update')->name('cabinet.profile.update');

    Route::get('/articles/file/{id}', 'ArticleController@file')->name('articles.file');
    Route::get('/articles/download/{id}', 'ArticleController@download')->name('articles.download');
    Route::get('/articles/authors', 'ArticleController@authors')->name('articles.authors');
    Route::get('/articles/journals', 'ArticleController@journals')->name('articles.journals');
    Route::resource('/articles', 'ArticleController');

    Route::resource('/journals', 'JournalController');

    Route::get('/patents', 'PatentController@index')->name('cabinet.patents');
    Route::get('/theses', 'ThesisController@index')->name('cabinet.theses');
});

Route::fallback(function () {
    print '<h1>404 -> Fallback route</h1>';
});
