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

Route::get('/', 'ArticlesController@index')->name('index');
Route::post('/', 'ArticlesController@create')->name('create.article');
Route::delete('/{id}', 'ArticlesController@delete')->name('delete.article');
Route::put('/{id}', 'ArticlesController@update')->name('update.article');