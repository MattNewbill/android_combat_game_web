<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

//Route::resource('users', 'UserController');



Route::get('users/get_is_valid_user_by_id/{id}', 'UserController@get_is_valid_user_by_id');
Route::post('users/create_user', 'UserController@create_user');

Route::post('games/create_game', 'GameController@create_game');
Route::post('games/set_is_active', 'GameController@set_is_active');
Route::post('games/join', 'GameController@join');


?>