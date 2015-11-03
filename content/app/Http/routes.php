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
Route::resource('flowers', 'FlowerController');

// Auth controllers (from Laravel)
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

// Block off users section to super_admin
Entrust::routeNeedsRole('admin*', 'super_admin', Redirect::to('home'));

// Glide Image Handling
$server = League\Glide\ServerFactory::create([
    'source' => 'storage/app/source',
    'cache' => 'storage/app/cache',
]);