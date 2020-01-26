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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/filan', function () {
    return App\TodoItem::all();
});

// bütün todo listesi
// yeni bir todo ekleme işlemi
// bir todoyu tamamlandı işaretlenme
// bir todoyu yapılmadı işaretleme

Route::get('todos', 'TodoItemController@index')->name('todos.all');
Route::get('todos/{todo}/togglecomplete', 'TodoItemController@toggle')->name('todos.toggle');
Route::post('todos', 'TodoItemController@store')->name('todos.store');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
