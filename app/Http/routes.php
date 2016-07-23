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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {
    Route::get('usuario', [
        'as' => 'users', 'uses' => 'UserController@index'
    ]);

    Route::get('usuario/{id?}', [
        'as' => 'users', 'uses' => 'UserController@edit'
    ]);

    Route::put('usuario/{id?}', [
        'as' => 'usuario/{id?}', 'uses' => 'UserController@update'
    ]);
    
    Route::post('usuario', 'UserController@store');
});