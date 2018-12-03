<?php

use Illuminate\Support\Facades\Auth;
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

    Route::get('/journals/ajax', 'Editions\JournalController@journalsNamesByAjaxAutocomplete')->name('journals.ajax');
    Route::resource('/journals', 'Editions\JournalController');

    Route::get('/authors/ajax', 'Publications\AuthorController@authorsNamesByAjaxAutocomplete')->name('authors.ajax');

    Route::post('/patent_bulletin/store', 'Editions\PatentBulletinController@store')->name('scientific.patent_bulletin.store');
});

Route::group([
    'middleware' => 'auth',
    'prefix' => 'cabinet/publications/scientific',
    'namespace' => 'Cabinet\Publications\Scientific',
    'as' => 'scientific.',
], function() {
    Route::get('/articles/file/{id}', 'Articles\ArticleController@displayFile')->name('articles.file');
    Route::get('/articles/download/{id}', 'Articles\ArticleController@downloadFile')->name('articles.download');
    Route::resource('/articles', 'Articles\ArticleController');

    Route::get('/patents/file/{id}', 'Patents\PatentController@displayFile')->name('patents.file');
    Route::get('/patents/download/{id}', 'Patents\PatentController@downloadFile')->name('patents.download');
    Route::resource('/patents', 'Patents\PatentController');

    Route::resource('/theses', 'Theses\ThesisController');

});

Route::group([
    'middleware' => 'auth',
    'prefix' => 'cabinet/publications/academic',
    'namespace' => 'Cabinet\Publications\Academic',
    'as' => 'academic.',
], function() {
    Route::get('/articles/file/{id}', 'Articles\ArticleController@displayFile')->name('articles.file');
    Route::get('/articles/download/{id}', 'Articles\ArticleController@downloadFile')->name('articles.download');
    Route::resource('/articles', 'Articles\ArticleController');

    Route::resource('/theses', 'Theses\ThesisController');
});

Route::fallback(function () {
    print '<h1>404 -> Fallback route</h1>';
});
