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

Route::prefix('v1')->group(function () {
    Route::get('articles', 'API\v1\ArticleConnection@getAllArticles');
    Route::get('articles/{id}', 'API\v1\ArticleConnection@getArticle');
    
    Route::post('articles', 'API\v1\ArticleConnection@postArticle');
    Route::delete('articles/{id}', 'API\v1\ArticleConnection@deleteArticle');
    Route::put('articles/{id}', 'API\v1\ArticleConnection@updateArticle');
});
