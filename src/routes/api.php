<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->namespace('Auth')->group(function () {
    Route::name('signup')->post('signup', 'AuthController@signUp');
    Route::name('signin')->post('signin', 'AuthController@signIn');
    Route::name('forgot-password')->post('password/restore', 'AuthController@passwordRestore');
    Route::name('reset-password')->post('password/reset', 'AuthController@passwordReset');

    Route::name('signup.oauth')->post('signup/{provider}', 'OAuthController@signup');
    Route::name('login.oauth')->post('login/{provider}', 'OAuthController@login');
});

Route::namespace('Stage')->group(function () {

    Route::name('city')->get('city', 'CityController@index');

    Route::prefix('group')->group(function () {
        Route::post('', 'GroupController@store');
        Route::put('{group}', 'GroupController@update');
        Route::post('by_email', 'GroupController@byEmail');
        Route::delete('{group}', 'GroupController@destroy');

        Route::post('select', 'GroupController@select');
        Route::post('export', 'GroupController@export');
    });

    Route::prefix('mission')->group(function () {

        Route::get('{id}', 'MissionController@showAPI');
        Route::post('', 'MissionController@create');

        Route::put('{id}', 'MissionController@update');
        Route::delete('{id}', 'MissionController@delete');
    });

});
