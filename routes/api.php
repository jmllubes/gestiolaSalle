<?php

use Illuminate\Http\Request;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('home', 'Api\HomeController@index');
    Route::get('categories', 'Api\IncidenceController@getCategories');
    Route::get('incidences', 'Api\IncidenceController@getIncidences');
    Route::get('incidence/{id}', 'Api\IncidenceController@getSingleIncidence');
    Route::get('user/{id}', 'Api\UsersController@getUser');
    Route::get('users', 'Api\UsersController@getUsers');
});

Route::group(['prefix' => 'users'], function() {
    Route::group(['middleware' => 'auth:api'], function() {
        Route::post('create', 'Api\UsersController@create');
        Route::post('modify/{id}', 'Api\UsersController@modify');
        Route::post('unsuscribe/{id}', 'Api\UsersController@unsuscribe');
        Route::post('suscribe/{id}', 'Api\UsersController@suscribe');
    });
});

Route::group(['prefix' => 'rols'], function() {
    Route::group(['middleware' => 'auth:api'], function() {
        Route::post('create/{id}', 'Api\RolController@create');
        Route::post('delete/{id}', 'Api\RolController@delete');
        Route::get('show/{id}', 'Api\RolController@show');
    });
});


Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'Api\AuthController@login');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'Api\AuthController@logout');
    });
});

Route::group(['prefix' => 'incidence'], function () {
    Route::group(['middleware' => 'auth:api'], function() {
        Route::post('create', 'Api\IncidenceController@create');
        Route::post('image/{id}', 'Api\IncidenceController@editImage');
        Route::post('edit/{id}', 'Api\IncidenceController@edit');
        Route::post('status/{id}/{status}', 'Api\IncidenceController@changeStatus');
        Route::post('comment/{id}', 'Api\CommentsController@insert');
    });
});
