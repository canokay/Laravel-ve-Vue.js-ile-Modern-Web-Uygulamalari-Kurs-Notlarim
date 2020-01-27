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

// route group example:  asd.com/api/auth/login
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'API\AuthController@login');
    Route::post('logout', 'API\AuthController@logout');
    Route::post('refresh', 'API\AuthController@refresh');
    Route::post('me', 'API\AuthController@me');
});

Route::get('todos', 'API\TodoController@index')->middleware(['auth:api']);
Route::post('todos', 'API\TodoController@store')->middleware(['auth:api']);
Route::put('todos/{todo}/toggle', 'API\TodoController@toggle')->middleware(['auth:api']);