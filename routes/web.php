<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth::routes(); - commented out to disable the registration and password reset functionality
// Only Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// General
Route::get('/cancel', 'HomeController@cancel')->name('cancel');

// Home
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
// - Submit a question on the client's side
Route::post('/submit-question', 'HomeController@submitQuestion')->name('submit-question');

// Dashboard
Route::get('/dashboard', 'DashboardController@home')->name('dashboard-home');


// - Categories
// - - Show all categories with some statistics on the related questions
Route::get('/dashboard/categories', 'CategoriesController@index')->name('show-categories');
// - - Show Category
Route::get('/dashboard/category/{category}', 'CategoriesController@show')->name('show-category');
// - - Create a new category in dashboard
Route::get('/dashboard/new-category', 'CategoriesController@create')->name('new-category-form');
Route::post('/dashboard/new-category', 'CategoriesController@store')->name('create-category');
// - - Delete Category
Route::get('/dashboard/{category}/delete', 'CategoriesController@delete')->name('delete-category-form');
Route::delete('/destroy/category/{category}', 'CategoriesController@destroy')->name('destroy-category');

// - Questions
// - - Create a new question in dashboard
Route::get('/dashboard/new-question', 'QuestionsController@create')->name('new-question-form');
Route::get('/dashboard/new-question/{category}', 'QuestionsController@createUnderCategory')->name('new-question-form-category');
Route::post('/dashboard/new-question', 'QuestionsController@storeByAdmin')->name('create-question');
// - - Edit a question
Route::get('/question/{question}/edit', 'QuestionsController@edit')->name('edit-question-form');
Route::patch('/question/{question}/update', 'QuestionsController@update')->name('update-question');
// - - Delete a question
Route::get('/question/{question}/delete', 'QuestionsController@delete')->name('delete-question-form');
Route::delete('/destroy/question/{question}', 'QuestionsController@destroy')->name('destroy-question');

// - Accounts
// - - Show Accounts
Route::get('/dashboard/accounts', 'UsersController@index')->name('show-accounts');
// - - New Account
Route::get('/dashboard/new-account', 'UsersController@create')->name('new-account-form');
Route::post('/dashboard/new-account', 'UsersController@store')->name('create-account');
// - - Edit Account
Route::get('/dashboard/user/{user}', 'UsersController@edit')->name('edit-account-form');
Route::patch('/dashboard/user/{user}/update', 'UsersController@update')->name('update-account');
// - - Delete Account
Route::get('/dashboard/user/{user}/delete', 'UsersController@delete')->name('delete-account-form');
Route::delete('/destroy/user/{user}', 'UsersController@destroy')->name('destroy-account');

// - Logs
// - - Show Logs
Route::get('/dashboard/logs', 'LogsController@show')->name('show-logs');
Route::get('/dashboard/logs/export', 'LogsController@exportFullLogs')->name('export-full-logs');











