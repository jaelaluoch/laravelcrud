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

Route::group([
    'prefix' => 'auth'
], function () {
    //Mpesa
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('signup', 'App\Http\Controllers\AuthController@signup');

    
    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::post('createStatus', 'App\Http\Controllers\StatusController@createStatus');
        Route::get('getStatus', 'App\Http\Controllers\StatusController@getStatus');
        Route::post('updateStatus', 'App\Http\Controllers\StatusController@updateStatus');
        Route::get('deleteStatus/{id}', 'App\Http\Controllers\StatusController@deleteStatus');
    
        Route::post('createTask', 'App\Http\Controllers\TaskController@createTask');
        Route::get('getTask', 'App\Http\Controllers\TaskController@getTask');
        Route::post('updateTask', 'App\Http\Controllers\TaskController@updateTask');
        Route::get('deleteTask/{id}', 'App\Http\Controllers\TaskController@deleteTask');

        Route::post('createUserTask', 'App\Http\Controllers\UserTaskController@createUserTask');
        Route::get('getUserTask', 'App\Http\Controllers\UserTaskController@getUserTask');
        Route::post('updateUserTask', 'App\Http\Controllers\UserTaskController@updateUserTask');
        Route::get('deleteUserTask/{id}', 'App\Http\Controllers\UserTaskController@deleteUserTask');
    });
});

