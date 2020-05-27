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


//Articles route
Route::get('articles', 'ArticleController@getAllArticles');
Route::get('articles/{id}', 'ArticleController@getArticle');

Route::post('articles', 'ArticleController@postArticle');
Route::delete('articles/{id}', 'ArticleController@deleteArticle');
Route::put('articles/{id}', 'ArticleController@updateArticle');