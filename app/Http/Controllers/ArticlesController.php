<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\API\v1\ArticleConnection as API;

class ArticlesController extends Controller
{
    function index(Request $request) {

        $articles = API::getAllArticles($request);

        $data = array(
            'title' => "Welcome",
            'articles' => $articles
        );
        
        return view('articles.index')->with($data);
    }

    function create(Request $request) {

       API::postArticle($request);

       return redirect()->route('index');

    }

    function delete(Request $request, $id){

        API::deleteArticle($request, $id);

        return redirect()->route('index');
    }

    function update(Request $request, $id){

        API::updateArticle($request, $id);

        return redirect()->route('index');
    }
    
} 
