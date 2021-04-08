<?php

use Illuminate\Support\Facades\Route;

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

Route::namespace('Auth')->name('auth.')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::name('login')->get('login', 'AuthController@login');
        Route::name('register')->get('register', 'AuthController@register');

        Route::name('forgot-password')->get('forgot-password', 'AuthController@forgotPassword');
        Route::name('reset-password')->get('password/reset', 'AuthController@resetPassword');
    });

    Route::name('logout')->get('logout', 'AuthController@logout');

});

Route::namespace('Stage')->name('stage.')->middleware('auth:web')->group(function () {

    Route::name('home')->get('/', 'GroupController@index');

    Route::name('')->resource('group', 'GroupController');
    Route::name('group.')->prefix('group')->group(function () {
        //...
    });

    Route::name('mission.')->prefix('mission')->group(function () {
        Route::name('show')->get('{mission}/{group?}', 'MissionController@show');
    });

});