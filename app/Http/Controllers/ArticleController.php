<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    public function getAllArticles(Request $request) {
        
        return Article::all();

    }

    public function getArticle(Request $request, $id) {

        if (Article::where('id', $id)->exists()) {
            return Article::where("id", $id)->get();

        } else {
            return response()->json([
                "message" => "article not found",
            ], 404);
        }        
    }

    public function postArticle(Request $request) {

        //request->all gives the body
        $article = new Article;
        $article->title = $request->input("title");
        $article->body = $request->input("body");

        $article->save();

        return response()->json([
            "message" => "article created"], 201);

    }

    public function deleteArticle(Request $request, $id){

        if (Article::where('id', $id)->exists()){
        
            $article = Article::find($id);
            $article->delete();

            return response()->json([
                "message" => "article successfully deleted"
            ], 201);
        } else {

            return response()->json([
                "message" => "article not found",
            ], 404);
        }
    }

    public function updateArticle(Request $request, $id){

        if (Article::where('id', $id)->exists()){

            $article = Article::find($id);
            $article->title = $request->input('title');
            $article->body = $request->input('body');
            $article->save();

            return response()->json([
                "message" => "message successfully updated",
            ], 201);
        } else {
            
            return response()->json([
                "message" => "article not found",
            ], 404);
        }
        
    }
}
