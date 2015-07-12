<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

// Homepage Controller
Route::get('home', 'HomeController@index');

// User-Facing Resource Controllers
Route::resource('things', 'ThingController');
Route::resource('reviews', 'ReviewController');
Route::get('categories', 'CategoryController@index');
Route::get('categories/{id}', 'CategoryController@show');
Route::resource('ratings', 'RatingController');
Route::resource('flag', 'FlagController');

// API Resource Controllers
Route::group(array('prefix' => 'api/v1', 'namespace' => 'api\v1'), function()
{
	Route::resource('things', 'ThingApiController');
	Route::resource('reviews', 'ReviewApiController');
	Route::get('categories', 'CategoryApiController@index');
	Route::resource('ratings', 'RatingApiController');
	Route::resource('flag', 'FlagApiController');
});

// Admin-Facing Resource Controllers
Route::group(array('prefix' => 'admin', 'namespace' => 'Admin'), function()
{
	Route::resource('users', 'UserController');
	Route::resource('categories', 'CategoryController');
	Route::resource('things', 'ThingController');
	Route::resource('reviews', 'ReviewController');
	Route::resource('flags', 'FlagController');
	Route::resource('votes', 'VoteController');
});

// Auth controllers (from Laravel)
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

// Block off users section to super_admin
Entrust::routeNeedsRole('admin*', 'super_admin', Redirect::to('home'));